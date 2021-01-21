<?php
ob_start();
include('../includes/db.php');
include('./includes/functions.php');
include('./includes/admin_header.php');
include('./includes/navigation.php');
?>

<!-- data fetching -->
<?php
$query = "SELECT * FROM posts";
$selectPostsQuery = mysqli_query($connection, $query);
$postsCount = mysqli_num_rows($selectPostsQuery);

$query = "SELECT * FROM comments";
$selectCommentsQuery = mysqli_query($connection, $query);
$commentsCount = mysqli_num_rows($selectCommentsQuery);

$query = "SELECT * FROM users";
$selectUsersQuery = mysqli_query($connection, $query);
$usersCount = mysqli_num_rows($selectUsersQuery);

$query = "SELECT * FROM categories";
$selectCategoriesQuery = mysqli_query($connection, $query);
$categoriesCount = mysqli_num_rows($selectCategoriesQuery);


// I don't know why these functions use numbers and not keys
//mysqli_fetch_all() when its output is printed, it shows keys and values
//but when the arrays are sent to filter array and printed, it shows INDECES and values
function filterDraftPosts($postRow)
{
  return $postRow[9] === 'draft';
}

function filterUnapprovedComments($commentRow)
{
  return $commentRow[5] === 'unapproved';
}

function filterSubscriberUsers($userRow)
{
  return $userRow[7] === 'subscriber';
}


$draftPostsCount = count(array_filter(mysqli_fetch_all($selectPostsQuery), "filterDraftPosts"));
$unapprovedCommentsCount = count(array_filter(mysqli_fetch_all($selectCommentsQuery), "filterUnapprovedComments"));
$subscriberUsersCount = count(array_filter(mysqli_fetch_all($selectUsersQuery), "filterSubscriberUsers"));
?>

<div id="wrapper">
  <div id="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            Blank Page
            <small>Subheading</small>
          </h1>
        </div>
      </div>

      <!-- widgets -->
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-file-text fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class="huge"><?php echo $postsCount ?></div>
                  <div>Posts</div>
                </div>
              </div>
            </div>
            <a href="posts.php">
              <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-green">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-comments fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class="huge"><?php echo $commentsCount ?></div>
                  <div>Comments</div>
                </div>
              </div>
            </div>
            <a href="comments.php">
              <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-yellow">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-user fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class="huge"><?php echo $usersCount ?></div>
                  <div>Users</div>
                </div>
              </div>
            </div>
            <a href="users.php">
              <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-red">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-list fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class="huge"><?php echo $categoriesCount ?></div>
                  <div>Categories</div>
                </div>
              </div>
            </div>
            <a href="categories.php">
              <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
      </div>

      <script type="text/javascript">
        google.charts.load('current', {
          'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Data', 'Count'],
            ['Posts', <?php echo $postsCount ?>],
            ['Draft Posts', <?php echo $draftPostsCount ?>],
            ['Comments', <?php echo $commentsCount ?>],
            ['Unapproved Comments', <?php echo $unapprovedCommentsCount ?>],
            ['Users', <?php echo $usersCount ?>],
            ['Subscribers', <?php echo $subscriberUsersCount ?>],
          ]);

          var options = {
            chart: {
              title: '',
              subtitle: '',
            }
          };

          var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

          chart.draw(data, google.charts.Bar.convertOptions(options));
        }
      </script>

      <div class="row">
        <div class="col-lg-12">
          <div id="columnchart_material" style="width: auto; height: 500px;"></div>
        </div>
      </div>

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

</div>
<?php include('./includes/footer.php'); ?>