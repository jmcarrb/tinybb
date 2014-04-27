<?php if (!$user[admin] == "1") { die("Permissions error, account is not admin."); } ?>
<style>
.paginate {
font-family:Arial, Helvetica, sans-serif;
	padding: 3px;
	margin: 3px;
}

.paginate a {
	padding:2px 5px 2px 5px;
	border:1px solid #999;
	text-decoration:none;
	color: #000;
}
.paginate a:hover, .paginate a:active {
	border: 1px solid #999;
	color: #000;
}
.paginate span.current {
	padding: 2px 5px 2px 5px;
		border: 1px solid #999;
		
		font-weight: bold;
		background-color: #999;
		color: #000;
	}
	.paginate span.disabled {
		padding:2px 5px 2px 5px;
		margin:2px;
		border:1px solid #eee;
		color:#fff;
	}

	ul{margin:6px;
	padding:0px;}	

</style>
<?php
        // PAGINATION SCRIPT CREDITS
        // http://papermashup.com/easy-php-pagination/
	$tableName="tinybb_categories";
	$targetpage = "index.php?page=home";
	$limit = 100;

	$query = "SELECT COUNT(*) as num FROM $tableName";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	
	$stages = 3;
	$page = mysql_escape_string($_GET['page']);
	if($page){
		$start = ($page - 1) * $limit; 
	}else{
		$start = 0;
		}

    // Get page data
	$query1 = "SELECT * FROM $tableName ORDER BY cat_order ASC LIMIT $start, $limit ";
	$result = mysql_query($query1);
 
	// Initial page num setup
	if ($page == 0){$page = 1;}
	$prev = $page - 1;	
	$next = $page + 1;							
	$lastpage = ceil($total_pages/$limit);		
	$LastPagem1 = $lastpage - 1;					
	
	
	$paginate = '';
	if($lastpage > 1)
	{	
	

	
	
		$paginate .= "<div class='paginate'>";
		// Previous
		if ($page > 1){
			$paginate.= "<a href='$targetpage&page=$prev'>previous</a>";
		}else{
			$paginate.= "";	}
			

		
		// Pages	
		if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page){
					$paginate.= "<span class='current'>$counter</span>";
				}else{
					$paginate.= "<a href='$targetpage&page=$counter'>$counter</a>";}
			}
		}
		elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
		{
			// Beginning only hide later pages
			if($page < 1 + ($stages * 2))		
			{
				for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage&page=$counter'>$counter</a>";}
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";		
			}
			// Middle hide some front and some back
			elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
			{
				$paginate.= "<a href='$targetpage&page=1'>1</a>";
				$paginate.= "<a href='$targetpage&page=2'>2</a>";
				$paginate.= "...";
				for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage&page=$counter'>$counter</a>";}
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage&page=$LastPagem1'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage&page=$lastpage'>$lastpage</a>";
			}
			// End only hide early pages
			else
			{
				$paginate.= "<a href='$targetpage&page=1'>1</a>";
				$paginate.= "<a href='$targetpage&page=2'>2</a>";
				$paginate.= "...";
				for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage&page=$counter'>$counter</a>";}
				}
			}
		}
					
				// Next
		if ($page < $counter - 1){ 
			$paginate.= "<a href='$targetpage&page=$next'>next</a>";
		}else{
			$paginate.= "";
			}
			
		$paginate.= "</div>";		
	
	
}echo "";
 // pagination
 echo $paginate;
?>
<table id="forum">
<th style="background-image:url('style/thread_header.png');"></th>
<th style="background-image:url('style/thread_header.png');"><center>Category</center></th>
<th style="background-image:url('style/thread_header.png');"><center>Newest Thread</center></th>
<th style="background-image:url('style/thread_header.png');"></th>
<th style="background-image:url('style/thread_header.png');"><center>Order</center></th>
<th style="background-image:url('style/thread_header.png');"><center>Admin Tools</center></th>
<?php
 while($row = @mysql_fetch_array($result))
		{
                  ?>

                            <tr>
                            <td align="center"><?php if ($row[cat_icon] == null){ echo "<img src='icons/none.gif' border='0'>"; } else { ?><img src='<?php echo "$row[cat_icon]"; ?>' border='0'><?php } ?></td>
                            <td style="max-width:150px;"><a href="?page=cat&cati=<?php echo "$row[cat_id]"; ?>"><?php echo "$row[cat_title]"; ?></a><br /><span style="font-size:10px;"><?php echo "$row[cat_desc]"; ?></span></td>
                            
                            <td align="center">
                            <?php
                                 $sql2 = "SELECT * FROM tinybb_threads WHERE cat_id = '$row[cat_id]' ORDER BY aid DESC LIMIT 1";
                                 $tt = mysql_query($sql2) or die (mysql_error());
                                 while($p=mysql_fetch_assoc($tt)){
                                 echo "<a href=\"index.php?page=thread&post=".$p['thread_key']."\">".$p['thread_title']."</a>";
                                }
                                ?>
                            </td>
                            <td align="center">
                            <?php
                                $result3 = mysql_query("SELECT * FROM tinybb_threads WHERE cat_id = '$row[cat_id]'");
                                $rthreads = mysql_num_rows($result3);
                                if ($rthreads == "1"){ echo "$rthreads Thread"; } else {
                                echo "$rthreads Threads";
                                }
                            ?>
                            </td>
                            
                            <td align="center">
                            <?php echo "$row[cat_order]"; ?>
                            </td>
                            <td align="center">
                            
                            <a href="admin.php?list=categories&do=delete&cat=<?php echo "$row[cat_id]"; ?>"><img src="icons/delete.gif" border="0" alt="Delete Category" title="Delete Category"></a>
                            <a href="admin.php?list=categories&do=edit&cat=<?php echo "$row[cat_id]"; ?>"><img src="icons/edit.gif" border="0" alt="Edit Category" title="Edit Category"></a>
                            </td>



                            </tr>

                  <?php } ?>
                  </table>