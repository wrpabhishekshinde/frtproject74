<?php
   include('header.php');
   checkUser();
   userArea();
   
   if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id']) && $_GET['id']>0){
   	$id=get_safe_value($_GET['id']);
   	mysqli_query($con,"delete from income where id=$id");
   	echo "<br/>Data deleted<br/>";
   }
   
   $res=mysqli_query($con,"select income.*,category.name from income, category 
   where income.category_id = category.id and income.added_by='".$_SESSION['UID']."' order by 
   income.income_date asc");
   ?>

<div class="main-content">
   <div class="section__content section__content--p30">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12">
               <h2>Income</h2>
               <a href="manage_income.php">Add Income</a>
               <br/><br/>
               <div class="table-responsive table--no-card m-b-30">
                  <table class="table table-borderless table-striped table-earning">
                     <thead>
                        <tr>
                             <td>ID</td>
                             <td>Category</td>
                             <td>Amount</td>
                             <td>Details</td>
                             <td>Income Date</td>
                              
                        </tr>
                     <tbody>

                     </tbody>
<?php
   if(mysqli_num_rows($res)>0){
   ?>
<script>
   setTitle("Income");
   selectLink('income_link');
</script>

                        <?php while($row=mysqli_fetch_assoc($res)){?>
                        <tr>
                           <td><?php echo $row['id'];?></td>
                           <td><?php echo $row['name']?></td>
                           <td><?php echo $row['amount']?></td>
                           <td><?php echo $row['details']?></td>                           
                           <td><?php echo $row['income_date']?></td>
                           <td>
                              <a href="manage_income.php?id=<?php echo $row['id'];?>">Edit</a>&nbsp;
                              <a href="javascript:void(0)" onclick="delete_confir('<?php echo $row['id'];?>','income.php')">Delete</a>
                           </td>
                        </tr>
                        <?php } ?>
                     
                  <?php } 
                     else{
                     	echo "No data found";
                     }
                     echo'</tbody>
                     </table>';
                     ?>
               </div>
            </div>
         </div>
      </div>

               
<?php
   include('footer.php');
   ?>
</div>
</div>