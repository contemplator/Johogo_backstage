<?php
	session_start();
	$folder = $_SESSION['account'];
	mkdir($folder, 0777);
	$image_url = "http://hdwallpaper.freehdw.com/0008/animals_widewallpaper_cat_74664.jpg";
 		
 		$kk=md5(rand());
 		while(file_exists($folder."/".$kk.".jpg")) {
		  $kk=md5(rand());
		}
	   	download_images($folder,$image_url,$kk);
	   	$path = $folder."/" .$kk.".jpg"."\"";
	echo $path;
	echo '<hr>';
	function download_images($folder,$image_url,$kk){
	    echo " image: ".$image_url;
	    # Download the image, report image size
	    $this_image_file =  download_binary_file($image_url, $ref="");
	    echo " size: ".strlen($this_image_file);
	    # Save the image
	    if(stristr($image_url, ".jpg") || stristr($image_url, ".gif") || stristr($image_url, ".png")){
	    	$fp = fopen($folder."/".$kk.".jpg", "w");
	    	fputs($fp, $this_image_file);
	        fclose($fp);
		}
	}
	function download_binary_file($file, $ref){
	    # Open a PHP/CURL session
	    $s = curl_init();
	    
	    # Configure the CURL command
	    curl_setopt($s, CURLOPT_URL, $file); // Define target site
	    curl_setopt($s, CURLOPT_RETURNTRANSFER, TRUE);     // Return in string
	    curl_setopt($s, CURLOPT_BINARYTRANSFER, 1);        // Indicate binary transfer
		curl_setopt($s, CURLOPT_REFERER, $ref);            // Referer value
		curl_setopt($s, CURLOPT_SSL_VERIFYPEER, FALSE);    // No certificate
		curl_setopt($s, CURLOPT_FOLLOWLOCATION, TRUE);     // Follow redirects
		curl_setopt($s, CURLOPT_MAXREDIRS, 4);             // Limit redirections to four
	    
	    # Execute the CURL command (Send contents of target web page to string)
	    $downloaded_page = curl_exec($s);
	    
	    # Close PHP/CURL session
	    curl_close($s);
	    
	    # return file
	    return $downloaded_page;
    }
?>
<script language="javascript" type="text/javascript">
	window.top.window.document.getElementById('hid_path').value = <?php echo $path; ?>;
   	window.top.window.stopUpload(<?php echo $path; ?>);
</script>  