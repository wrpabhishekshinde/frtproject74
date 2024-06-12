<?php  
include('header.php');
checkUser();
adminArea();
$msg="";
$question="";
$answer="";
$label="Add";
if(isset($_GET['id'])  &&  $_GET['id']>0){
    $label ="Edit";

    $id= get_safe_value($_GET['id']);

    $res=mysqli_query($con,"select * from qa where id =$id");
    if(mysqli_num_rows($res)==0){
        redirect('add_qa.php');
        die();
    }
    $row= mysqli_fetch_assoc($res);
    $category= $row['name'];

}


if(isset($_POST['submit'])){
    $question= get_safe_value($_POST['question']);
    $answer= get_safe_value($_POST['answer']);

    $type= "add";
    if(isset($_GET['id'])  &&  $_GET['id']>0){
        $type="edit";
        $sub_sql=" and id != $id";
    }

    $res=mysqli_query($con,"select * from qa where question ='$question' and answer= '$answer' $sub_sql");
    if(mysqli_num_rows($res)> 0)
    {
      $msg= "Question already exists";     
    }else{
            if($type=="edit")
            {
                mysqli_query($con,"update qa set question= '$question',answer ='$answer' where id=$id ");
                redirect('add_qa.php');
            }else{

                    mysqli_query($con,"insert into qa(question,answer) values ('$question','$answer')");
                    redirect('add_qa.php');
            }            
    }
}

?>
<script>
   setTitle("Manage Add Question");
   selectLink('chatbot_link');
</script>
<div class="main-content">
   <div class="section__content section__content--p30">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12">
               <h2><?php echo $label?> Question & Answer</h2>
               <a href="expense.php">Back</a>
               <div class="card">
                  <div class="card-body card-block">
                     <form method="post" class="form-horizontal">
                        <div class="form-group">												<label class="control-label mb-1">Question</label>
                           <input type="text" name="question" required value="<?php echo $question?>" class="form-control" rquired>
                        </div>
                        <div class="form-group">												<label class="control-label mb-1">Answer</label>
                           <input type="text" name="answer" required value="<?php echo $answer?>" class="form-control" rquired>
                        </div>
                        <div class="form-group">												
                           <input type="submit" name="submit" value="Submit"  class="btn btn-lg btn-info btn-block">                          
                        </div>
                        <div id="msg"><?php echo $msg?></div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
   include('footer.php');
   ?>