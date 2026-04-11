<?php include_once '../includes/header.inc.php'?>
<?php include_once '../includes/menus.inc.php'?>

<!-- Content Starts From Here -->

<main id="main" class="main">

    <!-- Content Header Starts -->
    <div class="pagetitle d-flex flex-md-row">

    
        <div>
            <div class="d-flex flex-column">
                <div class="d-flex align-items-center">
                    <div class="icons-sec">
                            <span class="iconify menu-icon" data-icon="clarity:grid-view-line"></span>
                    </div>
                    <div class="d-flex flex-column">
                        <h1 class="pb-0">Inspire Solutions</h1>
                        <nav>
                            <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                             <a href="../dashboard">Home </a> </li>
                            <li class="breadcrumb-item">Quiz Certificate List</li>
                            </ol>
                        </nav>
                    </div>
                    
                </div>
                
               
            </div>
            
           
        </div>
        <div class="ms-md-auto ms-0 mt-2 mt-md-0 d-flex align-items-center align-buttons">
          <a href="quiz-certificate-add" class="btn btn-primary theme-btn-inline"><span class="iconify" data-icon="bi:plus"></span> Add</a>
           
           
        </div>
    </div>
    <!-- Content Header Ends -->
    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
            
              
              <!-- grid Starts Here-->
                <div id="receipt-grid"></div>
              <!-- grid Ends Here-->

            </div>
          </div>

        </div>
      </div>
    </section>

</main>

  <!-- Content End Here -->

  <?php include_once '../includes/footer.inc.php'?>
<script>
var apiurl = "https://edinztech.com/inspire/admin/api/get.php?method=quiz_certificate_list";
var siteUrl ="https://edinztech.com/inspire/admin/";
    $(function() {
        $("#receipt-grid").jsGrid({
        height: "auto",
        width: "100%",
        inserting: false,
        editing: false,
        sorting: true,
        paging: true,
        filtering:true,
        pageLoading: false,
        loadIndication: true,
        data: [],
        noDataContent: "",
        autoload: true,
        deleteConfirm: "Do you really want to delete the record?",
        //        controller: 'AgencyInspection',
        controller: {

        loadData: function (filter) {
            criteria=filter;
            var data = $.Deferred();

            
            $.ajax({
              type: "GET",
              contentType: "application/json; charset=utf-8",
              url: apiurl,
              dataType: "JSON",
              data: { },

              //'ReportId': key
                }).done(function (response) {
                      var res=[];
                      if(criteria.quizname !=="")
                        {
                        response.forEach(function(element) {
                            if(element.quizname !== null){
                        if(element.quizname.toLowerCase().indexOf(criteria.quizname.toLowerCase()) > -1){
                            res.push(element);
                            response = res; }}	}, this);
                        }

                        if(criteria.quizid !=="")
                        {
                        response.forEach(function(element) {
                            if(element.quizid !== null){
                        if(element.quizid.toLowerCase().indexOf(criteria.quizid.toLowerCase()) > -1){
                            res.push(element);
                            response = res; }}	}, this);
                        }
                      else res = response;
                    data.resolve(res);
                });
                return data.promise();
            }

        },
        fields: [

           
            {
            name: "id", type: "text", title: "S.No", width: "80px",  align: 'center', validate: "required" },
            { name: "certificateid" , type: "text", title: "Certificate ID", width: "auto",  align: 'center', validate: "required"},
            //{ name: "duration" , type: "text", title: "Duration", width: "auto", align: 'center', validate: "required"},
            //{ name: "sdate" , type: "text", title: "S-Date", width: "auto",  align: 'center', validate: "required"},
            //{ name: "edate" , type: "text", title: "E-Date", width: "auto", align: 'center',  validate: "required"},
            //{ name: "stime" , type: "text", title: "S-Time", width: "auto", align: 'center', validate: "required"},
            //{ name: "etime" , type: "text", title: "E-Time", width: "auto", align: 'center', validate: "required"},
            //{ name: "price" , type: "text", title: "Price", width: "auto", align: 'center', validate: "required"},
            { name: "quizid" , type: "text", title: "Quiz ID", width: "auto", align: 'center', validate: "required"},
            { name: "quizname" , type: "text", title: "Quiz Name", width: "auto", align: 'center', validate: "required"},
            // { name: "startdate" , type: "text", title: "Start Date", width: "100px", align: 'center', validate: "required"},
            // { name: "enddate" , type: "text", title: "End Date", width: "100px", align: 'center', validate: "required"},
            // { name: "duration" , type: "text", title: "Duration", width: "100px", align: 'center', validate: "required"},
//----image----
            // {
            //   type: "control",
            //   width: 'auto',
            //   title: "Image",
            //   editButton: false,
            //   deleteButton: false,
            //   headerTemplate: function() {
            //       return $("<div>")
            //           .text(this.title);
            //   },
              
            //   itemTemplate: function(value, item) {
            //       var result = jsGrid.fields.control.prototype.itemTemplate.apply(this,
            //           arguments);
            //       var customviewButton = $(
            //           "<a class='btn btn-outline-info btn-rounded waves-effect view-btn' target='_blank'>"
            //       ).attr("href",  item.image).text("Image");
            //       return $("<div>").append(customviewButton);
            //   }
            // },
//----image----
            
            {
              type: "control",
              width: '100px',
              title: "Edit",
              editButton: false,
              deleteButton: false,
              headerTemplate: function() {
                  return $("<div>")
                      .text(this.title);
              },
              
              itemTemplate: function(value, item) {
                  var result = jsGrid.fields.control.prototype.itemTemplate.apply(this,
                      arguments);
                  var customviewButton = $(
                      "<a class='btn btn-outline-info btn-rounded waves-effect view-btn'>"
                  ).attr("href",  "https://edinztech.com/inspire/admin/course/quiz-certificate-edit?id="+item.id).text("Edit");
                  return $("<div>").append(customviewButton);
              }
            },

            {
                type: "control",
                width: '80px',
                title: "Delete",
                editButton: false,
                deleteButton: false,
                headerTemplate: function() {
                    return $("<div>")
                        .text(this.title);
                },
                itemTemplate: function(value, item) {
                    var $customDeleteButton = $("<button>").attr({
                        class: "customGridEditbutton jsgrid-button jsgrid-delete-button",
                        id: item.id
                    }).click(function(e) {
                        var token = item.id;
                        deleterecord(token);
                        e.stopPropagation();
                    });


                    return $("<div>").append($customDeleteButton);
                    //return $result.add($customButton);
                }
            }
        ]
    });

    function deleterecord(token) {
        var urldelete = siteUrl + "api/post";
        var deleteconfirm = confirm("Are you sure want to delete?");
        var objectvalue = {};
        objectvalue.key = "quiz_certificate_delete";
        objectvalue.id = token;
        if (deleteconfirm) {
            $.ajax({
                contentType: 'application/json; charset=utf-8',
                url: urldelete,
                type: "POST",
                dataType: "json",
                data: JSON.stringify(objectvalue),
                success: function(deletedata) {
                    console.log(deletedata);
                    window.location.reload();
                },
                error: function(error) {
                    console.log(error);
                }

            });
        }
    }
});

</script>
 




