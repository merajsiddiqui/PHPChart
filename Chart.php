<?php

/**
 * Main Class to Draw Chart and Graphs
 *
 * @author Faizan Ayubi
 */
class Chart {

    public $data;
    public $img;
    public $barWidth = 20;

    public function __construct($data) {
        $this->data = $data;
    }

    /**
     * Method to Draw Bar Graph
     * 
     * @param type $img_width Set Graph width
     * @param type $img_height Sets Graph Height
     * @param type $margins Sets Margin around Graph
     */
    function drawBar($img_width = 450, $img_height = 300, $margins = 20) {
        //Finding the size of graph by substracting the size of borders
        $graph_width = $this->automargin($img_width, $margins);
        $graph_height = $this->automargin($img_height, $margins);

        $img = imagecreate($img_width, $img_height);

        $total_bars = count($this->data);
        $gap = ($graph_width - $total_bars * $this->barWidth ) / ($total_bars + 1);

        //Defining Colors
        $bar_color = imagecolorallocate($img, 0, 64, 128);
        $background_color = imagecolorallocate($img, 240, 240, 255);
        $border_color = imagecolorallocate($img, 200, 200, 200);
        $line_color = imagecolorallocate($img, 220, 220, 220);

        //Create the border around the graph
        imagefilledrectangle($img, 1, 1, $img_width - 2, $img_height - 2, $border_color);
        imagefilledrectangle($img, $margins, $margins, $img_width - 1 - $margins, $img_height - 1 - $margins, $background_color);

        //Max value is required to adjust the scale
        $max_value = max($this->data);
        $ratio = $graph_height / $max_value;

        //Creating scale and draw horizontal lines
        $horizontal_lines = 20;
        $horizontal_gap = $graph_height / $horizontal_lines;

        for ($i = 1; $i <= $horizontal_lines; $i++) {
            $y = $img_height - $margins - $horizontal_gap * $i;
            imageline($img, $margins, $y, $img_width - $margins, $y, $line_color);
            $v = intval($horizontal_gap * $i / $ratio);
            imagestring($img, 0, 5, $y - 5, $v, $bar_color);
        }

        //Drawing the bars here
        for ($i = 0; $i < $total_bars; $i++) {
            # ------ Extract key and value pair from the current pointer position
            list($key, $value) = each($this->data);
            $x1 = $margins + $gap + $i * ($gap + $this->barWidth);
            $x2 = $x1 + $this->barWidth;
            $y1 = $margins + $graph_height - intval($value * $ratio);
            $y2 = $img_height - $margins;
            imagestring($img, 0, $x1 + 3, $y1 - 10, $value, $bar_color);
            imagestring($img, 0, $x1 + 3, $img_height - 15, $key, $bar_color);
            imagefilledrectangle($img, $x1, $y1, $x2, $y2, $bar_color);
        }
        $this->img = $img;
    }

    function drawPie($img_width = 500, $img_height = 500, $margins = 0){
        //set total sum = 0
        $data_sum = array_sum($this->data);
        //finding no of sectors
        $total_sectors = count($this->data);
        $angle_sum = array(-1 => 0, 360);
        $img = imagecreatetruecolor($img_width, $img_height);
        //defining variable colours for image
       $color = array( array(50, 30, 90), array(120, 240, 30),
        array(180,150,130), array(201, 240, 189), array(154, 198, 86),
        array(89, 163, 199), array(108, 213, 97), array(69, 250, 230),
        array(169, 250, 130), array(95, 150, 20), array(209, 29, 70), array(102, 201, 8));
       shuffle($color);
       $colors = array(imagecolorallocate($img, $color[0][0], $color[0][1], $color[0][2]));
       $colord = array(imagecolorallocate($img, ($color[0][0] / 1.5), ($color[0][1] / 1.5), ($color[0][2] / 1.5)));
            for($i=0; $i<$total_sectors; $i++){
            $angle[$i] = (($this->data[key($this->data)] / $data_sum) * 360);
            $angle_sum[$i+1] = array_sum($angle);
            $colors[$i] = imagecolorallocate($img, $color[$i][0], $color[$i][1], $color[$i][2]);
            $bg_color[$i] = imagecolorallocate($img, ($color[$i][0] / 1.5), ($color[$i][1] / 1.5), ($color[$i][2] / 1.5));
            $txtcolor[$i] =imagecolorallocate($img, ($color[$i][0] / 2.5), ($color[$i][1] /2.5), ($color[$i][2] / 2.5));
        }
        //end of for loop\
        //length of chord = 2rsin(c/2)
        for($i=0; $i<$total_sectors; $i++){
            imagefilledarc($img, $img_width/2, $img_height/2, $img_width, $img_height, $angle_sum[$i-1], $angle_sum[$i], $bg_color[$i], IMG_ARC_PIE);
        }
        //end of sectors

       return $this->img= $img;
    }
    function drawLine($multiline='f',$comp=3, $img_width = 500, $img_height = 500, $margins = 20, $lines=20)
    {
      $img = imagecreate($img_width, $img_height);
      $bar_color = imagecolorallocate($img, 0, 64, 128);
      $background_color = imagecolorallocate($img, 240, 240, 255);
      $border_color = imagecolorallocate($img, 200, 200, 200);
      $line_color = imagecolorallocate($img, 220, 220, 220);
      $graph_width = $this->automargin($img_width, $margins);
        $graph_height = $this->automargin($img_height, $margins);
        $red = imagecolorallocate($img, 255, 0, 0);
        $green= imagecolorallocate($img, 0, 150, 0);

      $total = count($this->data);
      $gap = ($graph_width - $total * $this->barWidth ) / ($total + 1);
      //Create the border around the graph
        imagefilledrectangle($img, 1, 1, $img_width - 2, $img_height - 2, $border_color);
        imagefilledrectangle($img, $margins, $margins, $img_width - 1 - $margins, $img_height - 1 - $margins, $background_color);

        //Max value is required to adjust the scale
        $max_value = max($this->data);
        $ratio = $graph_height / $max_value;

        //Creating scale and draw horizontal lines
        $horizontal_lines =$lines;
        $horizontal_gap = $graph_height / $horizontal_lines;

        for ($i = 1; $i <= $horizontal_lines; $i++) {
            $y = $img_height - $margins - $horizontal_gap * $i;
            imageline($img, $margins, $y, $img_width - $margins, $y, $line_color);
            $v = intval($horizontal_gap * $i / $ratio);
            imagestring($img, 0, 5, $y - 5, $v, $bar_color);
        }
        $last_val = array_values($this->data)[0];
        $x=$margins + $gap; $y=$margins + $graph_height - intval($last_val* $ratio);
        imagefilledarc($img, $x, $y, 10, 10, 0, 360, $bar_color, IMG_ARC_PIE);
       //Drawing the bars here
        for ($i = 0; $i < $total; $i++) {
            # ------ Extract key and value pair from the current pointer position
            list($key, $value) = each($this->data);
            $x1 = $margins + $gap + $i * ($gap + $this->barWidth);
            $y1 = $margins + $graph_height - intval($value * $ratio);
            imagestring($img, 5, $x1 + 5, $y1+5, $value, $bar_color);
            $sign= ($last_val<$value) ? "+" :"-";
            $change_color = ($last_val<$value) ? $green : $red;
            $num = abs(($last_val-$value)*100/$last_val);
            $change = ($i!=0) ? $sign.number_format($num, 2)."%" : "";
            imagestring($img, 5, $x1-10, $y1+20, $change, $change_color);
            imagestring($img, 5, $x1 -5, $img_height -20, $key, $bar_color);
            imageline ($img , $x, $y, $x1 , $y1 ,$bar_color);
            imagefilledarc($img, $x1, $y1, 10, 10, 0, 360, $bar_color, IMG_ARC_PIE);
            $x=$x1;
            $y=$y1;
            $last_val = $value;
        }
       return $this->img= $img;
    }
    function drawmultiLine($img_width = 500, $img_height = 500, $margins = 20, $lines=20, $comp=3)
 {
      $img = imagecreate($img_width, $img_height);
      $bar_color = imagecolorallocate($img, 0, 64, 128);
      $background_color = imagecolorallocate($img, 240, 240, 255);
      $border_color = imagecolorallocate($img, 200, 200, 200);
      $line_color = imagecolorallocate($img, 220, 220, 220);
      $graph_width = $this->automargin($img_width, $margins);
        $graph_height = $this->automargin($img_height, $margins);
        $red = imagecolorallocate($img, 255, 0, 0);
        $green= imagecolorallocate($img, 0, 150, 0);
        $another =imagecolorallocate($img, 11, 150, 110);
        $lcolor = array($bar_color, $green, $red, $another);

      $total = count($this->data);
      $gap = ($graph_width - $total * $this->barWidth ) / ($total + 1);
      //Create the border around the graph
        imagefilledrectangle($img, 1, 1, $img_width - 2, $img_height - 2, $border_color);
        imagefilledrectangle($img, $margins, $margins, $img_width - 1 - $margins, $img_height - 1 - $margins, $background_color);
      $key= array();
            $key = array_keys($this->data); 

        $keys2 = array();
        for($i=0;$i<=$comp; $i++){
        $keys2 = array_keys($this->data[key($this->data)]);
        }

        $final = array();
        for($i=0; $i<count($this->data); $i++){
        for($j=0; $j<count($keys2); $j++){
        $final[]= $this->data[$key[$i]][$keys2[$j]];
        }
        }
        
        //Max value is required to adjust the scale
        $max_value = max($final);
        $ratio = $graph_height / $max_value;

        //Creating scale and draw horizontal lines
        $horizontal_lines =$lines;
        $horizontal_gap = $graph_height / $horizontal_lines;

        for ($i = 1; $i <= $horizontal_lines; $i++) {
            $y = $img_height - $margins - $horizontal_gap * $i;
            imageline($img, $margins, $y, $img_width - $margins, $y, $line_color);
            $v = intval($horizontal_gap * $i / $ratio);
            imagestring($img, 0, 5, $y - 5, $v, $bar_color);
        }
        //drawing graph
        $x=$margins + $gap;
         
        for($ab= 0; $ab<count($keys2);$ab++){
            $x=$margins + $gap;
            $begin_val = array_values($this->data)[0][$keys2[$ab]];
            $y=$margins + $graph_height - intval($begin_val* $ratio);
            imagestring($img, 5, $margins + 5, $y, $keys2[$ab], $lcolor[$ab]);
         for ($i = 0; $i < $total; $i++) {
            # ------ Extract key and value pair from the current pointer position
            

            $x1 = $margins + $gap + $i * ($gap + $this->barWidth);
            $value =$this->data[$key[$i]][$keys2[$ab]];
            $y1 = $margins + $graph_height - intval($value * $ratio);
            imagestring($img, 5, $x1 + 5, $y1+5, $value, $lcolor[$ab]);
            /*
            $sign= ($last_val<$value) ? "+" :"-";
            $change_color = ($last_val<$value) ? $green : $red;
            $num = abs(($last_val-$value)*100/$last_val);
            $change = ($i!=0) ? $sign.number_format($num, 2)."%" : "";
            imagestring($img, 5, $x1-10, $y1+20, $change, $change_color);
            */
            imagestring($img, 5, $x1 -5, $img_height -20, $key[$i], $bar_color);
            imageline ($img , $x, $y, $x1 , $y1 ,$lcolor[$ab]);
            imagefilledarc($img, $x1, $y1, 10, 10, 0, 360, $lcolor[$ab], IMG_ARC_PIE);
            $x=$x1;
            $y=$y1;
        }

    }
       return $this->img= $img;
    }
    /**
     * Adjust Margin for graphs
     * @param type $length
     * @param type $margin
     * @return type
     */
    function automargin($length, $margin) {
        return $length - $margin * 2;
    }

    function __destruct() {
header("Content-type:image/png");
        imagepng($this->img);
    }

}