<?php 
/*
 * Simulates a database 
 */
class Data{

    public static function pages(){
        
       return array(
           
                'about-us',
                'products',
                'contact-us',
                'quote-request',
                'index',
                'manufacturer'
            );
        
    }
    
    
    public static function taxonomy_cat(){
        
       return array(
           
                'busway',
                'circuit-breakers',
                'fuses',
                'motor-control'
            );
        
    }    
    
    public static function taxonomy_man(){
        
       return array(  
           
                'siemens',
                'cutler-hammer',
                'ge',
                'square-d'
            );        
        
        
    } 
    
    
    public static function product(){
        
        return array(     
            
                '14JTM82WC',
                '14JTM82BD',
                '14JTM82SG',
                '14JTM82KL'
           );        
    }
    
    
    public static function build_product(){
        
       
        $product_array = array();
        
        $cat = self::taxonomy_cat();

        foreach($cat as $c):
            
            $man = self::taxonomy_man();
        
            foreach($man as $m):
                
                $prod = self::product();
            
                foreach($prod as $p):
                    
                    $product_array[] = $c.'/'.$m.'/'.$p;
                
                endforeach;
                
                
            endforeach;

        endforeach;
        
        return $product_array;

    }      

    
    
    
    
} 