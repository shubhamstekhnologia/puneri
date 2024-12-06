<?php

/*

 * FCKeditor - The text editor for Internet - http://www.fckeditor.net

 * Copyright (C) 2003-2009 Frederico Caldeira Knabben

 *

 * == BEGIN LICENSE ==

 *

 * Licensed under the terms of any of the following licenses at your

 * choice:

 *

 *  - GNU General Public License Version 2 or later (the "GPL")

 *    http://www.gnu.org/licenses/gpl.html

 *

 *  - GNU Lesser General Public License Version 2.1 or later (the "LGPL")

 *    http://www.gnu.org/licenses/lgpl.html

 *

 *  - Mozilla Public License Version 1.1 or later (the "MPL")

 *    http://www.mozilla.org/MPL/MPL-1.1.html

 *

 * == END LICENSE ==

 *

 * This is the File Manager Connector for PHP.

 */



function GetFolders( $resourceType, $currentFolder )

{

	// Map the virtual path to the local server path.

	$sServerDir = ServerMapFolder( $resourceType, $currentFolder, 'GetFolders' ) ;



	// Array that will hold the folders names.

	$aFolders	= array() ;



	$oCurrentFolder = @opendir( $sServerDir ) ;



	if ($oCurrentFolder !== false)

	{

		while ( $sFile = readdir( $oCurrentFolder ) )

		{

			if ( $sFile != '.' && $sFile != '..' && is_dir( $sServerDir . $sFile ) )

				$aFolders[] = '<Folder name="' . ConvertToXmlAttribute( $sFile ) . '" />' ;

		}

		closedir( $oCurrentFolder ) ;

	}



	// Open the "Folders" node.

	echo "<Folders>" ;



	natcasesort( $aFolders ) ;

	foreach ( $aFolders as $sFolder )

		echo $sFolder ;



	// Close the "Folders" node.

	echo "</Folders>" ;

}



function GetFoldersAndFiles( $resourceType, $currentFolder )

{

	// Map the virtual path to the local server path.

	$sServerDir = ServerMapFolder( $resourceType, $currentFolder, 'GetFoldersAndFiles' ) ;



	// Arrays that will hold the folders and files names.

	$aFolders	= array() ;

	$aFiles		= array() ;



	$oCurrentFolder = @opendir( $sServerDir ) ;



	if ($oCurrentFolder !== false)

	{

		while ( $sFile = readdir( $oCurrentFolder ) )

		{

			if ( $sFile != '.' && $sFile != '..' )

			{

				if ( is_dir( $sServerDir . $sFile ) )

					$aFolders[] = '<Folder name="' . ConvertToXmlAttribute( $sFile ) . '" />' ;

				else

				{

					$iFileSize = @filesize( $sServerDir . $sFile ) ;

					if ( !$iFileSize ) {

						$iFileSize = 0 ;

					}

					if ( $iFileSize > 0 )

					{

						$iFileSize = round( $iFileSize / 1024 ) ;

						if ( $iFileSize < 1 )

							$iFileSize = 1 ;

					}



					$aFiles[] = '<File name="' . ConvertToXmlAttribute( $sFile ) . '" size="' . $iFileSize . '" />' ;

				}

			}

		}

		closedir( $oCurrentFolder ) ;

	}



	// Send the folders

	natcasesort( $aFolders ) ;

	echo '<Folders>' ;



	foreach ( $aFolders as $sFolder )

		echo $sFolder ;



	echo '</Folders>' ;



	// Send the files

	natcasesort( $aFiles ) ;

	echo '<Files>' ;



	foreach ( $aFiles as $sFiles )

		echo $sFiles ;



	echo '</Files>' ;

}



function CreateFolder( $resourceType, $currentFolder )

{

	if (!isset($_GET)) {

		global $_GET;

	}

	$sErrorNumber	= '0' ;

	$sErrorMsg		= '' ;



	if ( isset( $_GET['NewFolderName'] ) )

	{

		$sNewFolderName = $_GET['NewFolderName'] ;

		$sNewFolderName = SanitizeFolderName( $sNewFolderName ) ;



		if ( strpos( $sNewFolderName, '..' ) !== FALSE )

			$sErrorNumber = '102' ;		// Invalid folder name.

		else

		{

			// Map the virtual path to the local server path of the current folder.

			$sServerDir = ServerMapFolder( $resourceType, $currentFolder, 'CreateFolder' ) ;



			if ( is_writable( $sServerDir ) )

			{

				$sServerDir .= $sNewFolderName ;



				$sErrorMsg = CreateServerFolder( $sServerDir ) ;



				switch ( $sErrorMsg )

				{

					case '' :

						$sErrorNumber = '0' ;

						break ;

					case 'Invalid argument' :

					case 'No such file or directory' :

						$sErrorNumber = '102' ;		// Path too long.

						break ;

					default :

						$sErrorNumber = '110' ;

						break ;

				}

			}

			else

				$sErrorNumber = '103' ;

		}

	}

}
