<?php namespace rodiger\iniParser;

/**
*  A sample class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author Rodiger Attila
*/

class iniParser {


    /**
     * INI file stucture in an array.
     * @var array
     */

    protected $structureArray;

    /**
     * INI file stucture in a 2 dimensional array. 1d section 2d is key=value
     * @var array
     */

    protected $iniArray;

    /**
     * Filename data of our .ini file.
     * @var string
     */

    protected $fileData;

    /**
     * Parses an INI file to Array
     *
     * @param string $filename
     * @param boolean $structure
     * @return array
     */

    public function iniFileToArray( string $filename, bool $structure = FALSE ) {

        $this->structureArray = Array();

        $section = "";

        $this->fileData = file( "../public/".$filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );

        foreach ( $this->fileData as $line ) {

            // Comment or whitespace
            if ( preg_match( '/^(;|#)/', $line ) ) {

                $this->structureArray[] = Array( 'type' => 'comment', 'data' => $line );
            
            } elseif ( preg_match( '/\[(.*)\]/', $line, $match ) ) { // Section
                
                $section                  = $match[1];
                $this->structureArray[]   = Array( 'type' => 'section', 'data' => $line, 'section' => $section );
                $this->iniArray[$section] = Array();
            
            } elseif ( preg_match( '/^\s*(.*?)\s*=\s*(.*?)\s*$/', $line, $match ) ) { // Entry

                $this->structureArray[] = Array( 'type' => 'entry', 'data' => $line, 'section' => $section, 'key' => $match[1], 'value' => $match[2] );
                $this->iniArray[$section][$match[1]] = $match[2];

            } // if ( preg_match( '/^\s*(;|#.*)?$/', $line ) ) end

        } // foreach ( $this->fileData as $line ) end

        if ( $structure === TRUE ) {

            return $this->structureArray;    

        } // if ( $structure === TRUE ) end

        return $this->iniArray;

    } // public function iniFileToArray( $filename ) end


    /**
     * Parses an array and create an INI file
     *
     * @param array $array
     * @param string $filename
     * @return string
     */

    public function arrayToIniFile( Array $array, string $filename ) {

        $this->fileData = "";

        foreach ( $array as $key => $value ) {

            if ( is_array( $value ) ) { // INI sections

                $this->fileData .= "[".$key."]".PHP_EOL;

                $maxKeyNumber = count( $value );
                $i            = 1;

                foreach ( $value as $k => $v ) {

                    $this->fileData .= $k."=".$v.PHP_EOL;

                    if ( $i == $maxKeyNumber ) {

                        $this->fileData .= "\n";

                    } // if ( $k == ( count( $value ) - 1 ) ) end

                    $i++;

                } // foreach ( $value as $k => $v ) end

            } // if ( !is_array( $value ) ) end
          
        } // foreach ( $array as $key => $value ) end

        $fp = fopen( "../public/".$filename, 'w' );
        fwrite( $fp, $this->fileData );
        fclose( $fp );

        return $this->fileData;

    } // public function arrayToIniFile( Array $array, string $filename ) vége

}