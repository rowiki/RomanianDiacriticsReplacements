<?php
/*
 * Copyright 2016 Strainu <http://www.strainu.ro/>
 *
 *
 * This source code is under the terms of the
 * GNU General Public License.
 * see <http://www.gnu.org/licenses/gpl.txt>
 */

class RomanianDiacriticsReplacements {
	private static function toEditContent( $page, $text ) {
		if ( $text === false || $text === null ) {
			return $text;
		}

		$content = ContentHandler::makeContent( $text, $page->getTitle(),
			$page->contentModel, $page->contentFormat );

		if ( !$page->isSupportedContentModel( $content->getModel() ) ) {
			throw new MWException( 'This content model is not supported: '
				. ContentHandler::getLocalizedName( $content->getModel() ) );
		}

		return $content;
	}

	public static function attemptSave( $m_pageObj ) {
		$namespace = $m_pageObj->getTitle()->getNamespace();
		// TODO: let the users customize the namespaces they don't want to use
		if ( $namespace !== 0 ) {
			return true;
		}

		$textbox_content = RomanianDiacriticsReplacements::toEditContent(
			$m_pageObj,
			$m_pageObj->textbox1
		);
		if ( $textbox_content->isRedirect() ) {
			return true;
		}

		$oldtext = $text = $m_pageObj->textbox1;
		$text = mb_ereg_replace( 'ţ', 'ț', $text );
		$text = mb_ereg_replace( 'Ţ', 'Ț', $text );
		$text = mb_ereg_replace( 'ş', 'ș', $text );
		$text = mb_ereg_replace( 'Ş', 'Ș', $text );
		$m_pageObj->textbox1 = $text;

		if ( $oldtext != $text ) {
			$m_pageObj->summary .= " ([[:ro:WP:DVN|corectat automat]])";
		}

		return true;
	}
}
