<?php
/**
 * This file implements the class BoardItem.
 * 
 * PHP versions 4 and 5
 *
 * LICENSE:
 * 
 * This file is part of PhotoShow.
 *
 * PhotoShow is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * PhotoShow is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with PhotoShow.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category  Website
 * @package   Photoshow
 * @author    Thibaud Rohmer <thibaud.rohmer@gmail.com>
 * @copyright 2011 Thibaud Rohmer
 * @license   http://www.gnu.org/licenses/
 * @link      http://github.com/thibaud-rohmer/PhotoShow
 */

/**
 * BoardItem
 *
 * Implements the displaying of an item of the grid on
 * the Website.
 *
 * @category  Website
 * @package   Photoshow
 * @author    Thibaud Rohmer <thibaud.rohmer@gmail.com>
 * @copyright Thibaud Rohmer
 * @license   http://www.gnu.org/licenses/
 * @link      http://github.com/thibaud-rohmer/PhotoShow
 */
class BoardItem implements HTMLObject
{
	/// URL-encoded relative path to file
	public $file;
	
	/// Path to file
	public $path;

	/// Ratio of the file
	public $ratio;
	
	/// Item width
	public $width;
	
	/**
	 * Construct BoardItem
	 *
	 * @param string $file 
	 * @param string $ratio 
	 * @author Thibaud Rohmer
	 */
	public function __construct($file,$ratio){
		$this->path 	= 	$file;
		$this->file		=	urlencode(File::a2r($file));
		$this->ratio	=	$ratio;
	}
	
	/**
	 * Display BoardItem on Website
	 *
	 * @return void
	 * @author Thibaud Rohmer
	 */
	public function toHTML(){

		$extension=strrchr($this->file,'.');
		// Comme le point ne vous intéresse pas
		// forcément on le supprime
		$extension=substr($extension,1) ;

		/// We display the image as a background
		echo 	"<div class='item";
		if(CurrentUser::$path == $this->path){
			echo " selected ";
		}
		echo 	" '";
		echo 	" style='";
		echo 	" width: 			$this->width%;";
		if($extension!==FALSE && $extension == "MP4") {
			echo 	" background: 		url(\"http://www.infivest.fr/wp-content/themes/Hermes/images/icon_play.png\") no-repeat center center;";
		}
    	else {
			echo 	" background: 		url(\"?$getfile\") no-repeat center center;";
			
    	} 
    	echo 	" -webkit-background-size: cover;";
		echo 	" -moz-background-size: cover;";
		echo 	" -o-background-size: cover;";
		echo 	" background-size: 	cover;";
		echo 	"'>\n";

		echo 	"<span class='name hidden'>".htmlentities(basename($this->path), ENT_QUOTES ,'UTF-8')."</span>";
		echo 	"<span class='path hidden'>".htmlentities(File::a2r($this->path), ENT_QUOTES ,'UTF-8')."</span>";
		
		echo 	"<a href='?f=$this->file'>";
		echo 	"<img src='./inc/img.png' width='100%' height='100%'>";
		echo 	"</a>\n";
		echo 	"</div>\n";
	}
	
	/**
	 * Calculate width (in percent) of the item : 
	 * 90 * item_ratio / line_ratio
	 *
	 * @param string $r 
	 * @return void
	 * @author Thibaud Rohmer
	 */
	public function set_width($line_ratio){
		$this->width = 90 * $this->ratio / $line_ratio;
	}
}

?>