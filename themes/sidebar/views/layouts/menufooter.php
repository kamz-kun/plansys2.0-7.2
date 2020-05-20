<?php 
    
    function loopMenuFooter($menu){
          $html = '';
          foreach($menu as $k => $v){
                if($v['label'] == '---'){
                     $html .= '';
                } else {
                     $html .= '<li>';
                     if(isset($v['url'])){
                        
                        if(is_array($v['url'])){
                            $url = $v['url'][0];
                            $params = $v['url'];
                            unset($params[0]);
                            $url = Yii::app()->createUrl($url, $params);
                            $html .= '<a href="' . $url .'">'.$v['label'].'</a>';	    
                        } else {
                            $url = Yii::app()->createUrl($url);
                            $html .= '<a href="' . $url .'">'.$v['label'].'</a>';	    
                        }
                        
                     } else {
                          $html .= '';	
                     }
                     if(isset($v['items'])){
                          $html .=  extractChildMobile($v['items']);
                     }
                     $html .= '</li>';
                }
          }
          return $html;
     }
     
     echo loopMenuFooter($menu[1]['items']);
?>


