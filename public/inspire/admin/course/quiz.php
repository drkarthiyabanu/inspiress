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
                            <li class="breadcrumb-item">Quiz List</li>
                            </ol>
                        </nav>
                    </div>
                    
                </div>
                
               
            </div>
            
           
        </div>
        <div class="ms-md-auto ms-0 mt-2 mt-md-0 d-flex align-items-center align-buttons">
        <a href="quiz-add" class="btn btn-primary theme-btn-inline"><span class="iconify" data-icon="bi:plus"></span> Add</a>   
        <a style="margin-left:10px;" class="btn btn-primary theme-btn-inline" onclick="myFunction()"><span class="iconify" data-icon="ph:trash-bold"></span> Truncate</a>   
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
var apiurl = "https://inspiress.in/admin/api/get.php?method=quiz_list";
var siteUrl ="https://inspiress.in/admin/";
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
                    //   console.log(response);
                      if(criteria.qid !=="")
                        {
                        response.forEach(function(element) {
                            if(element.qid !== null){
                        if(element.qid.toLowerCase().indexOf(criteria.qid.toLowerCase()) > -1){
                            res.push(element);
                            response = res; }}	}, this);
                        }

                        if(criteria.question !=="")
                        {
                        response.forEach(function(element) {
                            if(element.question !== null){
                        if(element.question.toLowerCase().indexOf(criteria.question.toLowerCase()) > -1){
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
            name: "sno", type: "text", title: "S.No", width: "20px",  align: 'center', validate: "required" },
            { name: "qid" , type: "text", title: "Q.Id", width: "30px",  align: 'center', validate: "required"},
            { name: "qno" , type: "text", title: "Q.No", width: "20px",  align: 'center', validate: "required"},
            { name: "question" , type: "text", title: "Question", width: "150px", align: 'center', validate: "required"},
            //{ name: "edate" , type: "text", title: "E-Date", width: "auto", align: 'center',  validate: "required"},
            //{ name: "stime" , type: "text", title: "S-Time", width: "auto", align: 'center', validate: "required"},
            //{ name: "etime" , type: "text", title: "E-Time", width: "auto", align: 'center', validate: "required"},
            //{ name: "price" , type: "text", title: "Price", width: "auto", align: 'center', validate: "required"},
            //{ name: "link" , type: "text", title: "Link", width: "auto", align: 'center', validate: "required"},
            // { name: "status" , type: "text", title: "Status", width: "100px", align: 'center', validate: "required"},
            // { name: "pin" , type: "text", title: "Pinned", width: "100px", align: 'center', validate: "required"},
//----image----
            {
              type: "control",   
              width: '15px',
              title: "Image",
              editButton: false,
              deleteButton: false,
              headerTemplate: function() {
                  return $("<div>")
                      .text(this.title);
              },
              
              itemTemplate: function(value, item) {
                  var result = jsGrid.fields.control.prototype.itemTemplate.apply(this,
                      arguments);
                      if(item.q_flag==1) {
                  var customviewButton = $(
                      "<a class='btn btn-outline-info btn-rounded waves-effect view-btn' target='blank'>"
                  ).attr("href",  "https://inspiress.in/admin/quiz_img/"+item.question_img).text("Image");
                      }
                  return $("<div>").append(customviewButton);
              }
            },
//----image----
            
            {
              type: "control",
              width: '15px',
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
                  ).attr("href",  "https://inspiress.in/admin/course/quiz-edit?sno="+item.sno).text("Edit");
                  return $("<div>").append(customviewButton);
              }
            },

            {
                type: "control",
                width: '10px',
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
                        id: item.sno
                    }).click(function(e) {
                        var token = item.sno;
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
        objectvalue.key = "quiz_delete";
        objectvalue.sno = token;
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
    };
});

</script>
<script>
        function myFunction() {
        var urldelete = siteUrl + "api/post";
        var deleteconfirm = confirm("Are you sure want to truncate?");
        var objectvalue = {};
        objectvalue.key = "quiz_truncate";
        if (deleteconfirm) {
            $.ajax({
                contentType: 'application/json; charset=utf-8',
                url: urldelete,
                type: "POST",
                dataType: "json",
                data: JSON.stringify(objectvalue),
                success: function(deletedata) {
                    // console.log(deletedata);
                    window.location.reload();
                },
                error: function(error) {
                    console.log(error);
                }

            });
        }
    };
    </script>
 




