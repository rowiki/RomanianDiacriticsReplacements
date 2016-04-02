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
	public static function attemptSave($m_pageObj) {
		$text = $m_pageObj->textbox1;
		$text = mb_ereg_replace('ţ', 'ț', $text );
		$text = mb_ereg_replace('Ţ', 'Ț', $text );
		$text = mb_ereg_replace('ş', 'ș', $text );
		$text = mb_ereg_replace('Ş', 'Ș', $text );
		$m_pageObj->textbox1 = $text;
		return true;
	}
}
