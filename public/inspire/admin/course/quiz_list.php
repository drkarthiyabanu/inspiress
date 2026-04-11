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
        <!-- <div class="ms-md-auto ms-0 mt-2 mt-md-0 d-flex align-items-center align-buttons">
          <a href="course-add" class="btn btn-primary theme-btn-inline"><span class="iconify" data-icon="bi:plus"></span> Add</a>
           
           
        </div> -->
  <button  class="btn btn-success waves-effect waves-light add-btn export-btn" id="export_csv" style="background-color:#ffa500; border-color:#ffa500">Export</button>

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
var apiurl = "https://edinztech.com/inspire/admin/api/get.php?method=quiz_clist";
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
                      if(criteria.id !=="")
                        {
                        response.forEach(function(element) {
                            if(element.id !== null){
                        if(element.id.toLowerCase().indexOf(criteria.id.toLowerCase()) > -1){
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
            {
            name: "cid", type: "text", title: "ID", width: "80px",  align: 'center', validate: "required" },
            {
            name: "qid", type: "text", title: "QID", width: "80px",  align: 'center', validate: "required" },
            { name: "name" , type: "text", title: "Name", width: "auto",  align: 'center', validate: "required"},
            //{ name: "duration" , type: "text", title: "Duration", width: "auto", align: 'center', validate: "required"},
            //{ name: "sdate" , type: "text", title: "S-Date", width: "auto",  align: 'center', validate: "required"},
            //{ name: "edate" , type: "text", title: "E-Date", width: "auto", align: 'center',  validate: "required"},
            //{ name: "stime" , type: "text", title: "S-Time", width: "auto", align: 'center', validate: "required"},
            //{ name: "etime" , type: "text", title: "E-Time", width: "auto", align: 'center', validate: "required"},
            //{ name: "price" , type: "text", title: "Price", width: "auto", align: 'center', validate: "required"},
            //{ name: "link" , type: "text", title: "Link", width: "auto", align: 'center', validate: "required"},
            { name: "mailid" , type: "text", title: "Email", width: "auto", align: 'center', validate: "required"},
            { name: "whatsapp" , type: "number", title: "Mobile", width: "auto", align: 'center', validate: "required"},
            { name: "mark" , type: "number", title: "Mark", width: "auto", align: 'center', validate: "required"},
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
            
            // {
            //   type: "control",
            //   width: '100px',
            //   title: "Edit",
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
            //           "<a class='btn btn-outline-info btn-rounded waves-effect view-btn'>"
            //       ).attr("href",  "https://inspiress.in/admin/course/course-edit?course_id="+item.course_id).text("Edit");
            //       return $("<div>").append(customviewButton);
            //   }
            // },

            // {
            //     type: "control",
            //     width: '80px',
            //     title: "Delete",
            //     editButton: false,
            //     deleteButton: false,
            //     headerTemplate: function() {
            //         return $("<div>")
            //             .text(this.title);
            //     },
            //     itemTemplate: function(value, item) {
            //         var $customDeleteButton = $("<button>").attr({
            //             class: "customGridEditbutton jsgrid-button jsgrid-delete-button",
            //             id: item.course_id
            //         }).click(function(e) {
            //             var token = item.course_id;
            //             deleterecord(token);
            //             e.stopPropagation();
            //         });


            //         return $("<div>").append($customDeleteButton);
            //         //return $result.add($customButton);
            //     }
            // }
        ]
    });

    function deleterecord(token) {
        var urldelete = siteUrl + "api/post";
        var deleteconfirm = confirm("Are you sure want to delete?");
        var objectvalue = {};
        objectvalue.key = "course_delete";
        objectvalue.course_id = token;
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
<script>
 $("#export_csv").click(function () {

//Jsgrid fileds
       var items = $("#receipt-grid").jsGrid("option", "data");
       var csv = convertArrayOfObjectsToCSV(items)

       var blob = new Blob(["\ufeff", csv]);

       if (navigator.msSaveBlob) { // IE 10+
           navigator.msSaveBlob(blob, "Quiz_List.csv")
       }
       else {
           var downloadLink = document.createElement("a");

           var url = URL.createObjectURL(blob);
           downloadLink.href = url;
           downloadLink.download = "Quiz_List.csv";
           document.body.appendChild(downloadLink);
           downloadLink.click();
           document.body.removeChild(downloadLink);
       }

   });
       function convertArrayOfObjectsToCSV(args) {
           var result, ctr, keys, columnDelimiter, lineDelimiter, data;

           data = args || null;
           if (data == null || !data.length) {
               return null;
           }

           columnDelimiter = args.columnDelimiter || ',';
           lineDelimiter = args.lineDelimiter || '\n';

           keys = Object.keys(data[0]);

           result = '';
           result += keys.join(columnDelimiter);
           result += lineDelimiter;

           data.forEach(function (item) {
               ctr = 0;
               keys.forEach(function (key) {
                   if (ctr > 0) result += columnDelimiter;

                   result = result + "\"" + item[key] + "\"";
                   //result += item[key];
                   ctr++;
               });
               result += lineDelimiter;
           });

           return result;
       }

       function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}


function bin2hex (bin)
{

  var i = 0, l = bin.length, chr, hex = ''

  for (i; i < l; ++i)
  {

    chr = bin.charCodeAt(i).toString(16)

    hex += chr.length < 2 ? '0' + chr : chr

  }

  return hex

}
</script>
 




