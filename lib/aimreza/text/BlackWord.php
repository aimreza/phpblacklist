<?php namespace aimreza\text;

class BlackWord{
   private $_blackList;
   private $_text;
   private $_badWords;
   public function __construct(array $blackWords){
     $this->setBlackList($blackWords);
   }
   
   protected function setBlackList(array $words){
     $this->_blackList = $this->_sortArrayByLength($words);
   }
   
   /**
    * Sort array elements by decending of its length
    * @params array 
    * @return array         
    */       
   private function _sortArrayByLength(array $words){
    usort($words, function($a,$b){
     $lena = strlen($a);
     $lenb = strlen($b); 
     if($lena == $lenb){ 
        return 0;
      }
      return ($lena > $lenb) ? -1 : 1; 
    });
    return $words;
   }
   
   public function getBlackList(){
     return $this->_blackList;
   }
   
   public function scan($text){
    $text =  $this->cleanWhiteSpace($text); 
    if(empty($this->_blackList) || empty($text)){
     return true;
    }else{
     return $this->doScan($text);
    }
     
   }
   
   protected function doScan($text){
    foreach($this->_blackList as $word){
        $word = $this->cleanWhiteSpace($word);
        $num = $this->countWord($word);
        if($num >1){
           $count = 0;
           $text = str_ireplace($word,'^*^*^',$text,$count);
           if($count>0){
             $this->_badWords[]=$word;
           }
        }else{
          $ret = $this->containsWord($text,$word);
          if($ret){
            $this->_badWords[]=$word;
          }
        }
    
    } 
    return !empty($this->_badWords);
   }
   
   public function getBadWords(){
    return $this->_badWords;
   }
   
   
   protected function countWord($string)
   {
    $string = htmlspecialchars_decode(strip_tags($string));
    if (strlen($string)==0)
        return 0;
    $t = array(' '=>1, '_'=>1, "\x20"=>1, "\xA0"=>1, "\x0A"=>1, "\x0D"=>1, "\x09"=>1, "\x0B"=>1, "\x2E"=>1, "\t"=>1, '='=>1, '+'=>1, '-'=>1, '*'=>1, '/'=>1, '\\'=>1, ','=>1, '.'=>1, ';'=>1, ':'=>1, '"'=>1, '\''=>1, '['=>1, ']'=>1, '{'=>1, '}'=>1, '('=>1, ')'=>1, '<'=>1, '>'=>1, '&'=>1, '%'=>1, '$'=>1, '@'=>1, '#'=>1, '^'=>1, '!'=>1, '?'=>1); // separators
    $count= isset($t[$string[0]])? 0:1;
    if (strlen($string)==1)
        return $count;
    for ($i=1;$i<strlen($string);$i++)
        if (isset($t[$string[$i-1]]) && !isset($t[$string[$i]])) // if new word starts
            $count++;
    return $count;
  }
  
 protected function containsWord($str, $word)
  {
    return !!preg_match('#\b' . preg_quote($word, '#') . '\b#i', $str);
  }
  
  protected function cleanWhiteSpace($text){
   return trim(preg_replace('/[\s\t\n\r\s]+/', ' ', $text));
  }
  
   
   
}
?>
