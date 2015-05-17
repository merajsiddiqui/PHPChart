## PHPChart ##
A Simple PHPChart Library to draw Graphs and Pie Charts etc

### How to Use ###
Include the Chart Class
```
include 'Chart.php';
```

Initialize the Class by adding Data to show in Array
```
$chart = new Chart(array(
    "Jan" => 110,
    "Feb" => 130,
    "Mar" => 215,
    "Apr" => 81,
    "May" => 310,
    "Jun" => 110,
    "Jul" => 190,
    "Aug" => 175,
    "Sep" => 390,
    "Oct" => 286,
    "Nov" => 150,
    "Dec" => 196
));
```

Finally Call the drawBar method to draw bar
```
$chart->drawBar();
```

### Example ###
A simple Bar Graph
![Bar Graph](https://github.com/faizanayubi/PHPChart/blob/master/example.png?raw=true)

### How to Use ###
Include the Chart Class
```
include 'Chart.php';
```

Initialize the Class by adding Data to show in Array
```
$chart = new Chart(array(
    "Jan" => 110,
    "Feb" => 130,
    "Mar" => 215,
    "Apr" => 81,
    "May" => 310,
    "Jun" => 110,
    "Jul" => 190,
    "Aug" => 175,
    "Sep" => 390,
    "Oct" => 286,
    "Nov" => 150,
    "Dec" => 196
));
```

Finally Call the drawPie method to draw Pie Graph
```
$chart->drawPie();
```
### Example ###
A simple PIe Graph
![Pie Graph](https://raw.githubusercontent.com/merajsiddiqui/PHPChart/master/example_pie.png?raw=true)



### How to Use ###
Include the Chart Class

```
include 'Chart.php';
```

Initialize the Class by adding Data to show in Array

```
$chart = new Chart(array(
    "Jan" => 110,
    "Feb" => 130,
    "Mar" => 215,
    "Apr" => 81,
    "May" => 310,
    "Jun" => 110,
    "Jul" => 190,
    "Aug" => 175,
    "Sep" => 390,
    "Oct" => 286,
    "Nov" => 150,
    "Dec" => 196
));
```

Finally Call the drawLine method to draw Line Graph
```
$chart->drawLine();
```
### Example ###
A simple Line Graph
![Line Graph](https://raw.githubusercontent.com/merajsiddiqui/PHPChart/master/exampl_line.png)


### How to Use ###
Include the Chart Class

```
include 'Chart.php';
```

Initialize the Class by adding Data to show in Array

```
$chart = new Chart(array(
    "Jan" => array("Google"=>87.5, "Yahoo" =>32.8, "Bing" =>12.6, "iSearch"=>43),
    "Feb" =>  array("Google"=>82.5, "Yahoo" =>60.8, "Bing" =>65.6, "iSearch"=>23),
    "Mar" =>  array("Google"=>52, "Yahoo" =>71.8, "Bing" =>83.2, "iSearch"=>63),
    "Apr" =>  array("Google"=>91, "Yahoo" =>33.8, "Bing" =>69.2, "iSearch"=>53)
));
```

Finally Call the drawmultiLine method to draw multiLine Graph
```
$chart->drawmultiLine();
```
### Example ###
A simple MultiLine Graph
![Line Graph](https://raw.githubusercontent.com/merajsiddiqui/PHPChart/master/example_multiline.png)
