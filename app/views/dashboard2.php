<!DOCTYPE html>
<html>
<head>
<!-- FORM CSS CODE -->
<?php include"comman/code_css_datatable.php"; ?>
<!-- </copy> -->  
<!-- jvectormap -->
<link rel="stylesheet" href="<?php echo $theme_link; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
<style type="text/css">
   #chart_container {
   min-width: 320px;
   max-width: 600px;
   margin: 0 auto;
   }
   .small-box{margin: 15px;}
   
</style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <!-- Notification sound -->
  <audio id="login">
    <source src="<?php echo $theme_link; ?>sound/login.mp3" type="audio/mpeg">
    <source src="<?php echo $theme_link; ?>sound/login.ogg" type="audio/ogg">
  </audio>
  <script type="text/javascript">
    var login_sound = document.getElementById("login"); 
  </script>
  <!-- Notification end -->
  <script type="text/javascript">
  <?php if($this->session->flashdata('success')!=''){ ?>
        login_sound.play();
  <?php } ?>
  </script>
  
  <?php include"sidebar.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$page_title;?>
        <small>Dashboard Information</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Home</li>
      </ol>
    </section><br/>
    <div class="row">
    <div class="col-md-12">
      <!-- ********** ALERT MESSAGE START******* -->
       <?php include"comman/code_flashdata.php"; ?>
       <!-- ********** ALERT MESSAGE END******* -->
     </div>
     </div>
     
     
      
        

      
    <!-- Main content -->
    <section class="content">
        
      <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
             <div class="info-box" >
                <span class="info-box-icon bg-fuchsia "style="border-radius: 100%;
background-color: #f012be !important;
width: 59px;
line-height: 60px;
height: 60px;
margin-top: 20px;"><i class="ion ion-bag"></i></span>
                <div class="info-box-content">
                   <span class="text-bold text-uppercase"><?= $this->lang->line('total_purchase_due'); ?></span>
                   <span class="info-box-number"><?= $CI->currency(app_number_format($purchase_due)); ?></span>
                </div>
                <!-- /.info-box-content -->
             </div>
             <!-- /.info-box -->
          </div> 
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
             <div class="info-box">
                <span class="info-box-icon bg-yellow"style="border-radius: 100%;
background-color: #f012be !important;
width: 59px;
line-height: 60px;
height: 60px;
margin-top: 20px;"><i class="fa fa-dollar"></i></span>
                <div class="info-box-content">
                   <span class="text-bold text-uppercase"><?= $this->lang->line('total_sales_due'); ?></span>
                   <span class="info-box-number"><?= $CI->currency(app_number_format($sales_due)); ?></span>
                </div>
                <!-- /.info-box-content -->
             </div>
             <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
             <div class="info-box">
                <span class="info-box-icon bg-green"style="
                border-radius: 100%;
background-color: #f012be !important;
width: 59px;
line-height: 60px;
height: 60px;
margin-top: 20px;;"><i class="fa fa-cart-plus"></i></span>
                <div class="info-box-content">
                   <span class="text-bold text-uppercase"><?= $this->lang->line('total_sales_amount'); ?></span>
                   <span class="info-box-number"><?= $CI->currency(app_number_format($tot_sal_grand_total)); ?></span>
                </div>
                <!-- /.info-box-content -->
             </div>
             <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
             <div class="info-box">
                <span class="info-box-icon bg-red "style="
                border-radius: 100%;
background-color: #f012be !important;
width: 59px;
line-height: 60px;
height: 60px;
margin-top: 20px;"><i class="fa fa-minus-square-o"></i></span>
                <div class="info-box-content">
                   <span class="text-bold text-uppercase"><?= $this->lang->line('total_expense_amount'); ?></span>
                     <span class="info-box-number"><?= $CI->currency(app_number_format($tot_exp)); ?></span>
                   </span>
                </div>
                <!-- /.info-box-content -->
             </div>
             <!-- /.info-box -->
          </div>
          <!-- /.col -->
       </div>
       <!-- /.row -->
      <!-- Info boxes -->
      <div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right  inner text-uppercase">
                  <div class='huge'><?= $tot_cust;?></h3><p><?= $this->lang->line('customers'); ?></div>
                        
                    </div>
                </div>
            </div>
            <a href="<?= base_url('#suppliers') ?>">
                <div class="panel-footer">
                   <!-- <?php //if($CI->session->userdata('inv_userid')==1){ ?> 
                    <a href="<?//= base_url('suppliers') ?>" class="small-box-footer text-uppercase">View <i class="fa fa-arrow-circle-right"></i>
                  </a> -->
                  <?php //} ?>
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-info ">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-group fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                     <div class='huge'><?= $tot_sup;?></h3><p><?= $this->lang->line('suppliers'); ?></div>
                     
                    </div>
                </div>
            </div>
            <a href="<?= base_url('#suppliers') ?>">
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
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <div class='huge'><?= $tot_pur;?></h3><p><?= $this->lang->line('purchase_invoice'); ?></div>
                      
                    </div>
                </div>
            </div>
            <a href="<?= base_url ('#purchase') ?>">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-danger ">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'><?= $tot_sal;?></h3><p><?= $this->lang->line('sales_invoice'); ?></div>
                       
                    </div>
                </div>
            </div>
            <a href="<?= base_url('#sales') ?>">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
</div>
                <!-- /.row -->

        <!-- /.col -->
        
      </div>
      <!-- /.row -->
    
     
      <!-- ############################# GRAPHS ############################## -->
     
      <!-- /.row -->
      <div class="row">
        <!-- /.row -->
   </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('footer'); ?>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- SOUND CODE -->
<?php include"comman/code_js_sound.php"; ?>
<!-- TABLES CODE -->
<?php include"comman/code_js_datatable.php"; ?>
<!-- bootstrap datepicker -->

<!-- ChartJS 1.0.1 -->
<script src="<?php echo $theme_link; ?>plugins/chartjs/Chart.min.js"></script>


<!-- Sparkline -->
<script src="<?php echo $theme_link; ?>plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo $theme_link; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo $theme_link; ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

 <!-- BAR CHART -->
<script src="<?php echo $theme_link; ?>plugins/highcharts/highcharts.js"></script>
<script src="<?php echo $theme_link; ?>plugins/highcharts/highcharts-more.js"></script>
<script src="<?php echo $theme_link; ?>plugins/highcharts/exporting.js"></script>
<!-- BAR CHART END -->
<!-- PIE CHART -->
<script src="<?php echo $theme_link; ?>plugins/highcharts/export-data.js"></script>
<!-- PIE CHART END -->

<!-- Make sidebar menu hughlighter/selector -->
<script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
<script>
  $(function () {
    $('#example2,#example3').DataTable({
      "pageLength" : 5,
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */


    //-------------
    //- BAR CHART -
    //-------------
    var barChartData = {
      labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"],
      datasets: [
        {
          label: "Purchase Amt(in <?= $CI->currency();?>)",
          fillColor: "rgba(210, 214, 222, 1)",
          strokeColor: "rgba(210, 214, 222, 1)",
          pointColor: "rgba(210, 214, 222, 1)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [<?php echo $jan_pur; ?>, <?php echo $feb_pur; ?>, <?php echo $mar_pur; ?>, <?php echo $apr_pur; ?>, <?php echo $may_pur; ?>, <?php echo $jun_pur; ?>, <?php echo $jul_pur; ?>, <?php echo $aug_pur; ?>, <?php echo $sep_pur; ?>, <?php echo $oct_pur; ?>, <?php echo $nov_pur; ?>, <?php echo $dec_pur; ?>]
        },
        {
          label: "Sales Amt(in <?= $CI->currency();?>)",
          fillColor: "rgba(60,141,188,0.9)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: [<?php echo $jan_sal; ?>, <?php echo $feb_sal; ?>, <?php echo $mar_sal; ?>, <?php echo $apr_sal; ?>, <?php echo $may_sal; ?>, <?php echo $jun_sal; ?>, <?php echo $jul_sal; ?>, <?php echo $aug_sal; ?>, <?php echo $sep_sal; ?>, <?php echo $oct_sal; ?>, <?php echo $nov_sal; ?>, <?php echo $dec_sal; ?>]
        }
      ]
    };
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    barChartData.datasets[1].fillColor = "#00a65a";
    barChartData.datasets[1].strokeColor = "#00a65a";
    barChartData.datasets[1].pointColor = "#00a65a";
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
  });


  /* PIE CHART*/
         Highcharts.chart('bar_container', {
             chart: {
                 plotBackgroundColor: null,
                 plotBorderWidth: null,
                 plotShadow: false,
                 type: 'pie'
             },
             title: {
                 text: '<?= $this->lang->line('top_10_trending_items'); ?> %'
             },
             tooltip: {
                 /*pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'*/
                 pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
             },
             plotOptions: {
                 pie: {
                     allowPointSelect: true,
                     cursor: 'pointer',
                     dataLabels: {
                         enabled: true,
                         format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                         style: {
                             color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                         }
                     }
                 }
             },
             series: [{
                 name: 'Item',
                 colorByPoint: true,
                 data: [
                 <?php 
            //PIE CHART
            $q3=$this->db->query("SELECT COALESCE(SUM(b.sales_qty),0) AS sales_qty, a.item_name FROM db_items AS a, db_salesitems AS b ,db_sales AS c WHERE a.id=b.`item_id` AND b.sales_id=c.`id` AND c.`sales_status`='Final' GROUP BY a.id limit 10");
            if($q3->num_rows() >0){
              foreach($q3->result() as $res3){
                  //extract($res3);
                  if($res3->sales_qty>0){
                  echo "{name:'".$res3->item_name."', y:".$res3->sales_qty."},";
                  }
              }
            }
            ?>
                 ]
             }]
         });
         /* PIE CHART END*/
</script>
</body>
</html>
