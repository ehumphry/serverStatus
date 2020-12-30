<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Baker SD Server Status</title>
  </head>

<body>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class='display-4'>Baker 5j Server Status</h1> 
    <!-- /<p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p> -->
  </div>
</div>

<div class="container-sm">
  <!-- Content here -->
<?php

    class CheckDevice {

        public function myOS(){
            if (strtoupper(substr(PHP_OS, 0, 3)) === (chr(87).chr(73).chr(78)))
                return true;

            return false;
        }

        public function ping($ip_addr){
            if ($this->myOS()){
                if (!exec("ping -n 1 -w 1 ".$ip_addr." 2>NUL > NUL && (echo 0) || (echo 1)"))
                    return true;
            } else {
                if (!exec("ping -q -c1 ".$ip_addr." >/dev/null 2>&1 ; echo $?"))
                    return true;
            }

            return false;
        }
    }

    function checkIP($ip_addr){
        if ((new CheckDevice())->ping($ip_addr)){
          echo "<div class='alert alert-success' role='alert'> $ip_addr  is running </div>";
       
        }
        else {
            global $alertCount; 
            $alertCount++;
            echo "<div class='alert alert-danger' role='alert'> $ip_addr  is not running! </div>";
    
        }

        

    }
    function checkIPwithName($ip_addr, $name){
        if ((new CheckDevice())->ping($ip_addr)){
            echo "<div class='alert alert-success' role='alert'> $name is running </div>";
        }   
        else {
            global $alertCount; 
            $alertCount++;
            echo "<div class='alert alert-danger' role='alert'> $name  is not running! </div>";
    
        }
       

    }

    
    $alertCount = 0;

    $server = array(
        'vhost1' => array("helpdesk.bakersd.org", "asset.bakersd.org", "BakerSD-BMS-1Vspace", "BakerSD-Keating","BakerSD-SMDE",
        "BSD-Apps","BSD-DC01", "BSD-Destiny", "BSD-FS", "BSD-Keating2", "BSD-LICENSING",
        "BSD-MGT","BSD-PS","BSD-PS2","BSD-Radius","BSD-UNIFI","BSD-UNIFI2" ),

        'vhost2' => array("BSD-DC02", "BSD-WEB1", "BSD-WG-Dimension", "BSD-WG-WebBlocker"),

        'vhost3' => array("BSD-FOG", "BSD-ITRM", "BSD-RDPBroker-1", "BSD-SIS2","BSD-Zabbix"),

        'avigilon1' => array("helpdesk.bakersd.org", "asset.bakersd.org", "BakerSD-BMS-1Vspace", "BakerSD-Keating","BakerSD-SMDE",
        "BSD-Apps","BSD-DC01", "BSD-Destiny", "BSD-FS", "BSD-Keating2", "BSD-LICENSING",
        "BSD-MGT","BSD-PS","BSD-PS2","BSD-Radius","BSD-UNIFI","BSD-UNIFI2"),

        'veeam1' => array("helpdesk.bakersd.org", "asset.bakersd.org", "BakerSD-BMS-1Vspace", "BakerSD-Keating","BakerSD-SMDE",
        "BSD-Apps","BSD-DC01", "BSD-Destiny", "BSD-FS", "BSD-Keating2", "BSD-LICENSING",
        "BSD-MGT","BSD-PS","BSD-PS2","BSD-Radius","BSD-UNIFI","BSD-UNIFI2")
    );
    
    $i = 0;
    foreach ($server as $host){   
        $names = array("Vhost1", "Vhost2", "Vhost3", "Avigilon 1", "Veeam 1" );
        echo "<h1 class='display-5'>$names[$i]</h1>";
        foreach($host as $ip_addr){
            if ($ip_addr == "BSD-PS"){
                $ip_addr = "172.16.0.113";
                $name = "BSD-PS";
                checkIPwithName($ip_addr, $name);
            }
            else{
                checkIP($ip_addr);
            }
        }
        $i++;
    }

    echo $message= "<h1 class='display-5'>Done!</h1>";  

  













    // $hosts = array("Vhost1", "Vhost2", "Vhost3", "Avigilon 1", "Veeam 1" );
    // // vhost 1
    // $item = array("helpdesk.bakersd.org", "asset.bakersd.org", "BakerSD-BMS-1Vspace", "BakerSD-Keating","BakerSD-SMDE",
    //                 "BSD-Apps","BSD-DC01", "BSD-Destiny", "BSD-FS", "BSD-Keating2", "BSD-LICENSING",
    //             "BSD-MGT","BSD-PS","BSD-PS2","BSD-Radius","BSD-UNIFI","BSD-UNIFI2", );

    // foreach ($hosts as $host) {           
    //     echo "<h1 class='display-5'>$host</h1>";
    //     foreach($item as $ip_addr){
    //         if ($ip_addr == "BSD-PS"){
    //             $ip_addr = "172.16.0.113";
    //             $name = "BSD-PS";
    //             checkIPwithName($ip_addr, $name);
    //         }
    //         else{
    //             checkIP($ip_addr);
    //         }
    //     }   
    //  break;      
    // }
    // echo $message= "<h1 class='display-5'>Done!</h1>";  

    // vhost 2 need to replace array with stuff
    // $item = array("helpdesk.bakersd.org", "asset.bakersd.org", "BakerSD-BMS-1Vspace", "BakerSD-Keating","BakerSD-SMDE",
    // "BSD-Apps","BSD-DC01", "BSD-Destiny", "BSD-FS", "BSD-Keating2", "BSD-LICENSING",
    // "BSD-MGT","BSD-PS","BSD-PS2","BSD-Radius","BSD-UNIFI","BSD-UNIFI2", );



?>
</div> 
</body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</html>