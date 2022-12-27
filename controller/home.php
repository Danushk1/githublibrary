<?php
    session_start();
    error_reporting(0);  
    include("databaseConnection.php");
    $username = $_SESSION['username'];

    if($_REQUEST['activity'] == 'logout'){
        $username = null;
        $username ="";
        unset($username);
        
        $_SESSION['username'] = null;
        $_SESSION['username'] ="";
        unset($_SESSION['username']);
        
        session_destroy();
    }

    if(empty($username)){
        header("location: ../Index.php");
    }

?>

<html>
    <head>
    	<title></title>
    	<link rel="stylesheet" type="text/css" href="../css/styleHome.css">
        <link rel="stylesheet" type="text/css" href="../css/styleUpdate.css">
        <link rel="stylesheet" type="text/css" href="../css/styleAddValue.css">
    </head>
    <body>
      <!--CONTAINER AREA  SECTION-->
        <div class="containerHome">
        <!--HEAD  SECTION-->
          <div class="headSection">

            <?php include("headSection.php"); ?>

          </div>
        <!--HEAD  SECTION-->

          <div class="navSection">
                <div class="welcomeTitle"><?php echo "Welcome : ".$username; ?></div>
                <div class="tooltip">Contact Us
                    <span class="tooltiptext">
                        <b>Address:</b> Greater Noida, Uttar Pradesh 201308<br>
                        <b>Phone:</b> 0120 4444532

                    </span>
                </div>
                <div class="logoutLink"><a href="home.php?activity=logout">Logout</a></div>
          </div>

        <!--LEFT BAR  SECTION-->
          <div class="leftSection">
            
            <?php include("leftSection.php");?>

          </div>
        <!--LEFT BAR  SECTION-->

        <!--CONTENT AREA  SECTION-->
        <div class="contentSection">
          
            <?php     
             // CODE FOR PERFORMMING ACTIVITY..

                        $activity = $_REQUEST['activity'];

                        if($activity) {
                            if($activity == 'addMember'){
                                include("addMember.php");
                            }

                            if($activity == 'dashboard'){
                                include("dashboard.php");
                            }
                               
                            if($activity == 'issueBooks'){
                                include("issueBooks.php");
                            }
                              
                            if($activity == 'returnBooks'){
                                include("returnBooks.php");
                            }   

                            if($activity == 'issueBooksHisory'){
                                include("issueBooksHistory.php");
                            }

                            if($activity == 'returnBooksHisory'){
                                include("returnBooksHisory.php");
                            }

                            if($activity == 'search'){
                                include("search.php");
                            }

                            if($activity == 'allRegisteredStudent'){
                                include("allRegisteredStudent.php");
                            }

                            if($activity == 'addBook'){
                                include("addBook.php");
                            }

                            if($activity == 'listAllBooks'){
                                include("listAllBooks.php");
                            }

                            if($activity == 'bookDetails'){
                                include("bookDetails.php");
                            }

                            if($activity == 'memberDetails'){
                                include("memberDetails.php");
                            }

                            if($activity == 'updateBook'){

                                $uBookId = $_REQUEST['uBookId'];

                                $return = mysql_num_rows(mysql_query("SELECT bookId From borrow Where bookId = '$uBookId'"));

                                if(empty($return)){
        
                                    $query = mysql_query("SELECT bookId,title,author,price,publisher From books Where bookId = '$uBookId'");
                                    $result = mysql_fetch_assoc($query);

                                    ?>
                                    <div class="updateBookTitle">Update Book</div>
                                    <div class="updatearea">
                                        <form action="home.php" class="updateForm">
                                            <input type="text" name="bookId" size="50" value=<?php echo $uBookId ?> readonly><br>
                                            <input type="text" name="bookName" required autofocus pattern="[A-Z a-z]{3,}" size="50" value=<?php  echo $result['title']; ?>><br>
                                            <input type="text" name="authorName" required autofocus pattern="[A-Z a-z]{3,}{.}" size="50" value=<?php echo $result['author']; ?>><br>
                                            <input type="text" name="bookPrice" required autofocus pattern="[A-Z a-z]{3,}{.}" size="50" value=<?php echo $result['price']; ?>><br>
                                            <input type="text" name="bookPublisher" required autofocus pattern="[A-Z a-z]{3,}" size="50" value=<?php echo $result['publisher']; ?>><br>

                                            <input type="submit" name="updateBookBtn" value="Update"><br>
                                        </form>
                                    </div>
                                    <?php
                                }
                                else{
                                    $errorMsg = "This Book is issued and can't be edit.";
                                    header("location: home.php?activity=listAllBooks");
                                    
                                }
                            }

                            if($activity == 'updateMember'){

                                $uMemberId = $_REQUEST['uMemberId'];
    
                                $query = mysql_query("SELECT * From members Where Id = '$uMemberId'");
                                $result = mysql_fetch_assoc($query);
                                
                                ?>
                                <div class="updateMemberTitle">Update Member</div>
                                <div class="updatearea">
                                    <form action="home.php" class="updateForm">
                                        <input type="text" name="memberId" value=<?php echo $uMemberId; ?> readonly><br>
                                        <input type="text" name="firstName" required autofocus pattern="[A-Z a-z]{3,}" value=<?php echo $result['FirstName']; ?>><br>
                                        <input type="text" name="lastName" value=<?php echo $result['LastName']; ?>><br>

                                        <div class="updateFormList" required autofocus>
                                            <select name="position">
                                                <option value="">Select</option>
                                                <option value="student" <?php if($result['position'] == "student"){ ?> selected <?php }?>>Student</option>
                                                <option value="faculty" <?php if($result['position'] == "faculty"){ ?> selected <?php }?>>Faculty</option>
                                            </select>
                                        </div> <br>

                                        <input type="text" name="mobile" value=<?php echo $result['Mobile']; ?>><br>
                                        <input type="email" name="email" value=<?php echo $result['Email']; ?>><br>
                                        <input type="text" name="course" value=<?php echo $result['Course']; ?>><br>

                                        <input type="submit" name="updateMemberBtn" value="Update"><br>
                                    </form>
                                </div>
                               
                                <?php
                                
                            }    

                            if($activity == 'deleteBook'){

                                $deleteBookId = $_REQUEST['deleteBookId'];

                                $result = mysql_num_rows(mysql_query("SELECT bookId FROM borrow Where bookId = '$deleteBookId'"));
                               
                                if(empty($result)){
                                $deleteResult = mysql_query("Delete From books Where bookId = '$deleteBookId'");

                                }
                                header("location: home.php?activity=listAllBooks");
                            }

                            if($activity == 'deleteMember'){

                                $deleteMemberId = $_REQUEST['deleteMemberId'];

                                $result = mysql_num_rows(mysql_query("SELECT issueId FROM borrow Where issueId = '$deleteMemberId'"));
                               
                                if(empty($result)){
                                    $deleteResult = mysql_query("Delete From members Where Id = '$deleteMemberId'");
                                }

                                header("location: home.php?activity=allRegisteredStudent");
                            }

                            if($activity == 'deleteReturnedBooksHistory'){

                                $deleteReturnId = $_REQUEST['deleteReturnId'];
                                $deleteReturnDate = $_REQUEST['deleteReturnDate'];

                                $deleteResult = mysql_query("Delete From borrow Where returnId = '$deleteReturnId' && returnDate = '$deleteReturnDate'");

                                    if($deleteResult){
                                        header("location: home.php?activity=returnBooksHisory");
                                    }
                            }

                        }
                        else{
                            //include("dashboard.php");
                        }
                    
                        
                    ?>

                    <?php
                    // CODE FOR UPDATE BOOK...

                        if(isset($_REQUEST['updateBookBtn'])){

                            $bookId = $_REQUEST['bookId'];
                            $bookName = $_REQUEST['bookName'];
                            $authorName = $_REQUEST['authorName'];
                            $bookPrice = $_REQUEST['bookPrice'];
                            $bookPublisher = $_REQUEST['bookPublisher'];

                            $query1 = mysql_query("UPDATE books Set title='$bookName', author='$authorName', price='$bookPrice', publisher='$bookPublisher' Where bookId = '$bookId'");

                                if($query1){
                                    //$errorMsg = "Book Updation is successfully done.";
                                    header("location: home.php?activity=listAllBooks");
                                }
                        }
                    ?>

                    <?php
                    // CODE FOR UPDATE MEMBER...

                        if(isset($_REQUEST['updateMemberBtn'])){

                            $memberId = $_REQUEST['memberId'];
                            $firstName = $_REQUEST['firstName'];
                            $lastName = $_REQUEST['lastName'];
                            $position = $_REQUEST['position'];
                            //$rollNo = $_REQUEST['rollNo'];
                            $mobile = $_REQUEST['mobile'];
                            $email = $_REQUEST['email'];
                            $course = $_REQUEST['course'];

                            $query1 = mysql_query("UPDATE members Set FirstName='$firstName', LastName='$lastName', Position='$position', Mobile='$mobile', Email='$email', Course='$course' Where Id = '$memberId'");

                            if($query1){
                                //$errorMsg = "Book Updation is successfully done.";
                                header("location: home.php?activity=allRegisteredStudent");
                            }
                        }    
                    ?>

                    <?php
                    //CODE TO SEARCH BOOK OR STUDENT USING THEIR ID..No error...

                        $searchList = $_REQUEST['searchList'];//SESSION['searchListValue'];
                        //echo $searchList;
                        if(isset($searchList)){

                            if($searchList == 'Book'){

                                $searchField = $_REQUEST['searchField'];

                                if($searchField){

                                    $query = "SELECT bookId,title,author,price,available FROM books Where title LIKE '%$searchField%'";
                                    $returnD = mysql_query($query);
                                    $returnD1 = mysql_query($query);
                                    $result = mysql_fetch_assoc($returnD);

                                    if(empty($result)){
                                        $errorMsg = "Invalid Book Name...";
                                    }

                                }
                                else{
                                    $errorMsg = "Field can't be Empty...";
                                }

                            }
                            elseif($searchList == 'Member'){

                                $searchField = $_REQUEST['searchField'];

                                if(!empty($searchField)){

                                    $query = "SELECT Id,FirstName,LastName,Mobile,Email,Course FROM Members Where FirstName LIKE '%$searchField%' || LastName LIKE '%$searchField%'";
                                    $returnD = mysql_query($query);
                                    $returnD1 = mysql_query($query);
                                    $result = mysql_fetch_assoc($returnD);

                                    if(empty($result)){
                                        $errorMsg = "Invalid Customer Name...";
                                    }

                                }
                                else{
                                    $errorMsg = "Field can't be Empty...";
                                }
                            }

                            include("search.php");
                        }
                    ?>

                    <?php
                    //CODE TO ISSUE BOOKS.. NO error..

                            if(isset($_REQUEST['issueBtn'])){ //if click on issue button..

                            $issueBookId = $_REQUEST['issueBookId'];
                            $issuerId = $_REQUEST['issuerId'];

                            if(!empty($issueBookId) && !empty($issuerId)){ //checks that both fields is not empty..

                                $query1 = "Select bookId From books Where bookId = '$issueBookId'";
                                $returnD1 = mysql_query($query1);
                                $result1 = mysql_fetch_assoc($returnD1);

                                $query2 = "Select Id From members Where Id = '$issuerId'";
                                $returnD2 = mysql_query($query2);
                                $result2 = mysql_fetch_assoc($returnD2);

                                if($issueBookId == $result1['bookId'] && $issuerId == $result2['Id']){ //checks that book or issuer id exists or not..

                                    $query3 = "Select bookId,issueId From borrow Where bookId = '$issueBookId'";
                                    $returnD3 = mysql_query($query3);
                                    $result3 = mysql_fetch_assoc($returnD3);

                                    if($issueBookId != $result3['bookId']){//checks that book is already issued or not..

                                        date_default_timezone_set('Asia/Kolkata');
                                        $dt = date("y/m/d h:i:s");

                                        $query = "Insert Into borrow(bookId,issueId,issueDate) Values('$issueBookId','$issuerId','$dt')";        
                                        $returnD = mysql_query($query);

                                        $queryForUnavailableBook = mysql_query("Update books Set available = 0 Where bookId = '$issueBookId'");

                                        if($returnD){
                                            $errorMsg = "Book has been successfully issued.";
                                        }
                                        else{
                                            $errorMsg = "Problem in issueing this book.";
                                        }
                                    }
                                    else{
                                        $errorMsg = "already issued to ".$result3['issueId'].".";
                                    }

                                }
                                elseif($issueBookId != $result1['bookId']){
                                    $errorMsg = "Please! Enter valid Book-Id.";
                                }
                                elseif($issuerId != $result2['Id']){
                                    $errorMsg = "Please! Enter valid Issuer-Id.";
                                }
                            }
                            else{
                                $errorMsg = "Both fields can't be Empty.";
                            }

                            include("issueBooks.php");
                        }
                    ?>

                    <?php
                    // CODE TO RETURN BOOKS.. No error..

                        if(isset($_REQUEST['returnBtn'])){//checks that return button is clicked or not...

                            $returnId = $_REQUEST['returnId'];
                            $returnBookId = $_REQUEST['returnBookId'];

                            if(!empty($returnId) && !empty($returnBookId)){ //checks that both fields are filled or not...

                                $query1 = "Select bookId,issueId,returnId From borrow Where bookId = '$returnBookId' && issueId = '$returnId'";
                                $returnD1 = mysql_query($query1);
                                $result1 = mysql_fetch_assoc($returnD1);

                                if($returnId == $result1['issueId'] && $returnBookId == $result1['bookId']){ //checks that book is issued or not or student id exists or not...

                                    date_default_timezone_set('Asia/Kolkata');
                                    $dt = date("y/m/d h:i:s");

                                    $query2 = "Update borrow Set returnBookId = '$returnBookId',bookId = '', returnId = '$returnId', issueId = '' , returnDate = '$dt' Where bookId = '$returnBookId' && issueId = '$returnId'";
                                    $returnD2 = mysql_query($query2);

                                    $queryForAvailableBook = mysql_query("Update books Set available = 1 Where bookId = '$returnBookId'");
                                
                                    if($returnD2){ //checks that book is returned or not..
                                        $errorMsg = "Book has been successfully returned.";
                                    }
                                    else{
                                        $errorMsg = "Problem in returning this book.";
                                    }

                                }
                                else{
                                    $errorMsg = "Book-Id or Issued-Id does not Exists or may not be issued.";
                                }
                            }
                            else{
                                $errorMsg = "Both fields must be filled.";
                            }

                            include("returnBooks.php");
                        }   
                    ?>

                    <?php 
                    //CODE T0 ADD BOOK.. No error..

                        $query = "Select Max(bookId) From books";
                        $returnD = mysql_query($query);
                        $result = mysql_fetch_assoc($returnD);
                        $maxRows = $result['Max(bookId)'];
                        if(empty($maxRows)){
                            $lastRow = $maxRows = 1001;      
                        }else{
                            $lastRow = $maxRows + 1 ;
                        }

                        if(isset($_REQUEST['addBookBtn'])){

                            $bookId = $_REQUEST['bookId'];
                            $bookName = $_REQUEST['bookName'];
                            $authorName = $_REQUEST['authorName'];
                            $bookPrice = $_REQUEST['bookPrice'];
                            $bookPublisher = $_REQUEST['bookPublisher'];

                            if(!empty($bookId) && !empty($bookName) && !empty($authorName)){

                                if($maxRows){

                                    $query = "Insert Into books(bookId,title,author,price,publisher,available) Values('$bookId','$bookName','$authorName','$bookPrice','$bookPublisher','1')";
                                    mysql_query($query);
                                    $errorMsg = "Book Sucessfully Added.";

                                    $query = "Select Max(bookId) From books";
                                    $returnD = mysql_query($query);
                                    $result = mysql_fetch_assoc($returnD);
                                    $maxRows = $result['Max(bookId)'];
                                    if(empty($maxRows)){
                                        $lastRow = $maxRows = 1001;      
                                    }else{
                                        $lastRow = $maxRows + 1 ;
                                    }
                                }
                                else{
                                    $errorMsg = "Table is Empty.";
                                }

                            }
                            else{
                                $errorMsg = "Please! Enter in Empty Field.";
                            }

                            include("addBook.php");
                        }
                    ?>

                    <?php 
                    // CODE TO ADD MEMBER.. No error..

                        $query = "Select Max(Id) From members";
                        $returnD = mysql_query($query);
                        $result = mysql_fetch_assoc($returnD);
                        $maxRows = $result['Max(Id)'];
                        if(empty($maxRows)){
                            $lastRow = $maxRows = 1;      
                        }else{
                            $lastRow = $maxRows + 1 ;
                        }

                        if(isset($_REQUEST['addMemberBtn'])){

                            $memberId = $_REQUEST['memberId'];
                            $firstName = $_REQUEST['firstName'];
                            $lastName = $_REQUEST['lastName'];
                            $position = $_REQUEST['position'];
                            //$rollNo = $_REQUEST['rollNo'];
                            $mobile = $_REQUEST['mobile'];
                            $email = $_REQUEST['email'];
                            $course = $_REQUEST['course'];


                            if(!empty($memberId) && !empty($firstName) && !empty($lastName) && !empty($mobile)){

                                if($maxRows){

                                        $query = "Insert Into members(Id,FirstName,LastName,Position,Mobile,Email,Course) Values('$memberId','$firstName','$lastName','$position','$mobile','$email','$course')";
                                        mysql_query($query);
                                        $errorMsg = "Member Sucessfully Added.";

                                        $query = "Select Max(Id) From members";
                                        $returnD = mysql_query($query);
                                        $result = mysql_fetch_assoc($returnD);
                                        $maxRows = $result['Max(Id)'];
                                        if(empty($maxRows)){
                                            $lastRow = $maxRows = 1;      
                                        }else{
                                            $lastRow = $maxRows + 1 ;
                                        }

                                }
                                else{
                                    $errorMsg = "Table is Empty.";
                                }

                            }
                            else{
                                $errorMsg = "Please! Enter in Empty Field.";
                            }

                            include("addMember.php");
                        }
                    ?>

                <?php
                if(isset($errorMsg)){
                    ?>
                <div class="errorMsg"><?php echo $errorMsg; ?></div>
                    <?php
                    }
                ?>

        </div>
        <!--CONTENT AREA  SECTION-->

        <!--RIGHT AREA  SECTION-->
          <div class="rightSection">
            
          <?php include("rightSection.php");?>

          </div>
        <!--RIGHT AREA  SECTION-->

        </div>
        <!--CONTAINER AREA  SECTION-->
    </body>
</html>
