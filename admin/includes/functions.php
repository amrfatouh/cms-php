<?php
//checking query
function checkQuery($sentQuery)
{
  global $connection;
  if (!$sentQuery) {
    die("Query Failed! " . mysqli_error($connection));
  }
}

//create category query sending
function createCategory()
{
  if (isset($_POST['cat_title'])) {
    global $connection;
    $query = "INSERT INTO categories(cat_title) VALUES ('{$_POST['cat_title']}')";
    $insertCategoryQuery = mysqli_query($connection, $query);
    if (!$insertCategoryQuery) {
      die('Query Failed! ' . mysqli_error($connection));
    }
  }
}

//delete category query sending
function deleteCategory()
{
  global $connection;
  if (isset($_GET['delete'])) {
    $cat_id = $_GET['delete'];
    $query = "DELETE FROM categories WHERE cat_id = $cat_id";
    $categoryDeletionQuery = mysqli_query($connection, $query);
    if (!$categoryDeletionQuery) {
      die("Deletion Query Failed! " . mysqli_error($connection));
    }
  }
}

//edit category query sending
function editCategory()
{
  global $connection;
  if (isset($_POST['updated_cat_title'])) {
    $cat_id = $_POST["cat_id"];
    $cat_title = $_POST['updated_cat_title'];
    $query = "UPDATE categories SET cat_title = '$cat_title' WHERE cat_id = $cat_id";
    $categoryEditQuery = mysqli_query($connection, $query);
    if (!$categoryEditQuery) {
      die('Query Edit Failed! ' . mysqli_error($connection));
    }
  }
}
