<?php
     try {
          $menu = Yii::app()->controller->mainMenu;
     } catch (CdbException $e) {
          $menu = [];
     }
     if(true){ //if menu items available open bracket
     
?>
    <div id="menu-sidebar">
  <nav>
    <h2><?php echo Yii::app()->user->info['username'] ?></h2>
    <ul>
                <?php
            $html = '';
            if((sizeof(Yii::app()->user->info) > 1)){ //if menu items available open bracket
                foreach($menu as $k => $v){
                    
                   if($k > 1){
                        if($v['label'] == '---'){
                        } else {
                            if(isset($v['items'])){
                                $html .= '<li>';
                            } else {
                                $html .= '<li>';
                            }
                             
                             if(isset($v['url'])){
                                 $url = is_array($v['url']) ? $v['url'][0] : $v['url'];
                                $url = Yii::app()->createUrl($url);
                                $html .= '<a href="' . $url .'"><i class="fa '.$v['icon'].'"></i> '.$v['label'];	
                             } else {
                                  $html .= '<a href="#"><i class="fa '.$v['icon'].'"></i> '.$v['label'];	
                             }
                             if(isset($v['items'])){
                                  $html .=  ' <i></i>';
                             }
                             $html .= '</a>';
                             if(isset($v['items'])){
                                  $html .=  extractChild($v['items']);
                             }
                             $html .= '</li>';
                        }
                    }
                } 
            }            
            echo $html;
            $this->includeFile('menufooter.php', [
                                'menu' => $menu
                           ]);    
         ?>
    </ul>
  </nav>
</div>
<?php
	} //if menu items available close bracket
?>


<?php
     function getHeaderMenu(){
          
          return "
               <li id='menu-header'>
                    <h3>Test</h3>
               </li>
          
          ";
     }
     function loopMenuMobile($menu){
          $html = '';
          foreach($menu as $k => $v){
               if($k > 1){
                    if($v['label'] == '---'){
                         $html .= '';
                    } else {
                         $html .= '<li>';
                         if(isset($v['url'])){
                             $url = is_array($v['url']) ? $v['url'][0] : $v['url'];
                            $url = Yii::app()->createUrl($url);
                            $html .= '<a href="' . $url .'">'.$v['label'].'</a>';	
                         } else {
                              $html .= '<a href="#">'.$v['label'].'</a>';	
                         }
                         if(isset($v['items'])){
                              $html .=  extractChildMobile($v['items']);
                         }
                         $html .= '</li>';
                    }
               }
          }
          return $html;
          
          
     }
     
     function extractChildMobile($item){
          $html = '<ul class="dl-submenu">';
          foreach($item as $k => $v){
               if($v['label'] == '---'){
                    $html .= '';
               } 
               else {
                    
                    $html .= '<li>';
                    if(isset($v['url'])){
                        if(is_array($v['url'])){
                            $url = $v['url'][0];
                            $params = $v['url'];
                            unset($params[0]);
                            $url = Yii::app()->createUrl($url, $params);
                            $html .= '<a href="' . $url .'">'.$v['label'].'</a>';	    
                        } else {
                            $url = Yii::app()->createUrl($v['url']);
                            $html .= '<a href="' . $url .'">'.$v['label'].'</a>';	    
                        }
                    } else {
                         $html .= '<a href="#">'.$v['label'].'</a>';          
                    }
                    if(isset($v['items'])){
                         $html .=  extractChildMobile($v['items']);
                    }
                    $html .= '</li>';     
               }
               
          }
          $html .= '</ul>';
          return $html;
     }
     
     function extractChild($item){
          $html = '<ul>';
          foreach($item as $k => $v){
               if($v['label'] == '---'){
                $html .= '';
               } 
               else {
                    if(isset($v['items'])){
                        $html .= '<li>';
                    } else {
                        $html .= '<li>';
                    }
                    
                    if(isset($v['url'])){
                        if(is_array($v['url'])){
                            $url = $v['url'][0];
                            $params = $v['url'];
                            unset($params[0]);
                            $url = Yii::app()->createUrl($url, $params);
                            if(isset($v['icon'])) {
                                $html .= '<a href="' . $url .'"><i class="fa '.$v['icon'].'"></i>&nbsp '.$v['label'].'</a>';
                            } else {
                                $html .= '<a href="' . $url .'">'.$v['label'].'</a>';
                            }
                        } else {
                            $url = Yii::app()->createUrl($v['url']);
                            if(isset($v['icon'])) {
                                $html .= '<a href="' . $url .'"><i class="fa '.$v['icon'].'"></i>&nbsp '.$v['label'].'</a>';
                            } else {
                                $html .= '<a href="' . $url .'">'.$v['label'].'</a>';
                            }
                        }
                    } else {
                         $html .= '<a href="#">'.$v['label'].'</a>';          
                    }
                    if(isset($v['items'])){
                         $html .=  extractChild($v['items']);
                    }
                    $html .= '</li>';     
               }
               
          }
          $html .= '</ul>';
          return $html;
     }

?>