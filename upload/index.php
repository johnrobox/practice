<!doctype html>
<head>
    <title>  Multiple File Upload using PHP, JQuery & Ajax : Devzone.co.in</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="jquery.form.js"></script><script src="das.js"></script>
    <style>
        /*
        * Code By Abhishek R. Kaushik
        * Downoaded fron http://devzone.co.in
        */
        /* CSS for Uploader */
        body { padding: 30px }
        form { display: block; margin: 20px 5px; background: #eee; border-radius: 10px; padding: 15px;width: 367px; }
        .progress { position:relative; width:400px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
        .bar { background-color: #66CCCC; width:0%; height:20px; border-radius: 3px; }
        .percent { position:absolute; display:inline-block; top:3px; left:48%; color: #E6F7F7;}
        #anc_add_more{background-color: #66CCCC; color: #FFF;padding: 7px;text-decoration: none; }
        .dv_add{margin-bottom: 25px;}
    </style>

    <script>
        /* JS for Uploader */
        $(function() {
            /* Append More Input Files */
            $('#anc_add_more').click(function() {
                $('#spn_inputs').append('<input type="file" name="myfile[]"><br>');
            });
        });

    </script>
</head>
<body>
    <div class="main">
        <div class="header"><a title="devzone.co.in" href="http://devzone.co.in/"><img alt="devzone.co.in" src="http://devzone.co.in/wp-content/uploads/tn_mesocolumn_header_logo.png"></a>
        </div>

        <div class="content">
            <div class="heading">
                Multiple File Upload using PHP, JQuery & Ajax
            </div>

            <div id='dv1'>

                <div class="dv_add">  <a href="javascript:void(0);" id="anc_add_more">Add More File</a></div>
                <div class="progress">
                    <div class="bar"></div >
                    <div class="percent">0%</div >
                </div>    
                <div id="status"></div>
                <form action="file.php" method="post" id='frm_upld' enctype="multipart/form-data">
                    <span id='spn_inputs'> 
                        <input type="file" name="myfile[]"><br>
                        <input type="file" name="myfile[]"><br>
                        <input type="file" name="myfile[]"><br>
                    </span>
                    <input type="submit"   value="Upload File(s)">
                </form>
                <script>/* JS for Uploader */
                    (function() {

                        var bar = $('.bar');
                        var percent = $('.percent');
                        var status = $('#status');

                        $('form').ajaxForm({
                            beforeSend: function() {
                                status.empty();
                                var percentVal = '0%';
                                bar.width(percentVal)
                                percent.html(percentVal);
                            },
                            uploadProgress: function(event, position, total, percentComplete) {
                                var percentVal = percentComplete + '%';
                                bar.width(percentVal)
                                percent.html(percentVal);

                            },
                            success: function() {
                                var percentVal = '100%';
                                bar.width(percentVal)
                                percent.html(percentVal);
                            },
                            complete: function(xhr) {
                                status.html(xhr.responseText);
                            }
                        });
                    })();
                </script>
            </div>
        </div></div>
</body>

<style>
    .main { 
        width: 750px; 
        margin: 0 auto; 
        height: 900px;
        border: 1px solid #ccc;
        padding: 20px;
    }

    .header{
        height: 100px;    
    }
    .content{    
        height: 700px;
        border-top: 1px solid #ccc;
        padding-top: 15px;
    }
    .footer{
        height: 100px;  
        bottom: 0px;
    }
    .heading{
        color: #FF5B5B;
        margin: 10px 0;
        padding: 10px 0;
        font-family: trebuchet ms;
    }
    /*downloaded from http://devzone.co.in*/
</style>
</html>