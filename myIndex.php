<!DOCTYPE html>
<html>
<head>
    <title>Gonzalo González MD5 Cracker</title>
</head>

<body>
    <h1>Gon's MD5 Cracker</h1>
    <p>My app takes MD5 hashes
    of a 4-digit PIN and 
    check all 10,000 possible 4-digit PINs to determine the PIN.</p>
    
    <pre>
        <p>Debug Output (first 15 attempts):</p>
        <?php
        $goodtext = "Not found";
        // If there is no parameter, this code is all skipped
        if ( isset($_GET['md5']) ) {
            $time_pre = microtime(true);
            $md5 = $_GET['md5'];

            // These are our digits
            $txt = "0123456789";
            $show = 15;

            // Outer loop go go through the digits for the
            // first position in our "possible" pre-hash
            // text
            for($i=0; $i<strlen($txt); $i++ ) {
                $ch1 = $txt[$i];   // The first of four digits

                // Our inner loop Note the use of new variables
                // $j and $ch2 
                for($j=0; $j<strlen($txt); $j++ ) {
                    $ch2 = $txt[$j];  // Our second digit

                    for($k=0; $k<strlen($txt); $k++ ) {
                    $ch3 = $txt[$k];  // Our third digit

                        for($l=0; $l<strlen($txt); $l++ ) {
                        $ch4 = $txt[$l];  // Our fourth digit

                        // Concatenate the 4 digits together to 
                        // form the "possible" pre-hash text
                        $try = $ch1.$ch2.$ch3.$ch4;
                        // Run the hash and then check to see if we match   
                        $check = hash('md5', $try);
                        if ( $check == $md5 ) {
                            $goodtext = $try;
                            break;   // Exit the inner loop
                        }
        
                            // Debug output until $show hits 0
                            if ( $show > 0 ) {
                                print "$check $try\n";
                                $show = $show - 1;
                            }
                        }
                    }
                }
            }
            // Compute elapsed time
            $time_post = microtime(true);
            print "\nElapsed time: ";
            print $time_post-$time_pre;
            print "\n";
        }
        ?>
    </pre>
    
    <!-- Use the very short syntax and call htmlentities() -->
    <p>PIN: <?= htmlentities($goodtext); ?></p>
    
    <form method="get">
        <input type="text" name="md5" size="40" />
        <input type="submit" value="Crack MD5"/>
    </form>
    
    <ul>
        <li><a href="index.php">Reset</a></li>
        <li><a href="md5.php">MD5 Encoder</a></li>
        <li><a href="makecode.php">MD5 Code Maker</a></li>
        <li><a
        href="https://github.com/ggdmj23/MyCrack"
        target="_blank">Source code for this application</a></li>
    </ul>
</body>
</html>

