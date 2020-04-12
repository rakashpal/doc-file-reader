<?php
include_once 'vendor/autoload.php';


use PhpOffice\PhpWord\Element\{
    Line,
    Section,
    Table,
    Text,
    TextBreak,
    TextRun
};


use PhpOffice\PhpWord\IOFactory;

class DecParser
{
    /**
     * @param string $c_file_name
     * @return array
     * @throws \Exception
     */
    public function get_doc_tables_array(string $c_file_name,$search) : string
    {
        $a_tables = '';

        $readerName = null;
        if (preg_match('/\.(\w*)$/', $c_file_name, $a_matches)) {
            if ($a_matches[1] == 'docx') $readerName = 'Word2007';
            else if ($a_matches[1] == 'doc') $readerName = 'MsDoc';
        }//
        // dump('Reader name: ' . $readerName);
        $phpWord = IOFactory::load($c_file_name, $readerName);
        $a_sections = $phpWord->getSections();

        $table_index = 0;
        foreach ($a_sections as $this_section) {

            foreach ($this_section->getElements() as $el) {
                // if ($el instanceof Table) {
				// 	print_r($el);
                //     foreach ($el->getRows() as $row_index => $row) {
                //         $a_tables[$table_index][$row_index] = [];
                //         foreach ($row->getCells() as $col_index => $cell) {
                //             $a_tables[$table_index][$row_index][$col_index] = '';

                //             foreach ($cell->getElements() as $cell_el) {
                //                  $a_tables .= self::extract_text_from_element($cell_el);
                //             }//endforeach

                //         }//endforeach
                //     }//endforeach

                   
                // }//endif
                // else{
                     $a_tables .= self::extract_text_from_element($el,$search); 
               // }
            }//endforeach

        }//endforeach
        return $a_tables;
    }//end of function

    /**
     * @param $el
     * @param int $depth
     * @return null|string
     * @throws \Exception
     */
    private static function extract_text_from_element($el,$search,$depth = 0) :? string
    {

        $c_text = null;

        if ($depth > 100) throw new \Exception("Depth of recursions is over the limit of 100 in " . __METHOD__);

        if ($el instanceof Line) {
            $c_text = "\n\n";

        } else if ($el instanceof TextBreak) {
            $c_text = "\n";

        } else if ($el instanceof Text) {
            
            if(is_null($search)){
                $c_text = $el->getText();
            }else{
            if(strtolower($search)==strtolower($el->getText())){
                $_SESSION['is_found'] = 1;           
            }else if(isset( $_SESSION['is_found'])){
                $c_text = $el->getText();
                unset( $_SESSION['is_found']);
            }
        }

        } else if ($el instanceof TextRun) {
            $depth++;
            $a_elements = $el->getElements();

            $c_text = '';
            foreach($a_elements as $this_el) {
                $c_text .= self::extract_text_from_element($this_el, $depth);
            }//endforeach

            if (count($a_elements) > 0 ) {
                $c_text .= "\n";
            }//endif
        }//endif
	

        return $c_text;
    }//end of function

}//end of class