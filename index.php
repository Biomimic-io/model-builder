<?php 

if(isset($_GET['debug'])){
        error_reporting(E_ERROR);
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
    }
    
//SIMPLE PHP File To Save Formbuilder Json to .json
$models = array_diff(scandir('models/'), array('..', '.'));



if(isset($_GET['mode'])&&$_GET['mode']=='save'){
    file_put_contents("models/".$_GET['model'].".json", $_POST['data']);
    echo 'done';
    exit;
}

?>
<!DOCTYPE html>
<html lang="en" >

<head>

  <meta charset="UTF-8">
  
<link rel="apple-touch-icon" type="image/png" href="https://cpwebassets.codepen.io/assets/favicon/apple-touch-icon-5ae1a0698dcc2402e9712f7d01ed509a57814f994c660df9f7a952f3060705ee.png" />
<meta name="apple-mobile-web-app-title" content="CodePen">

<link rel="shortcut icon" type="image/x-icon" href="https://cpwebassets.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico" />

<link rel="mask-icon" type="image/x-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-8f3771b1072e3c38bd662872f6b673a722f4b3ca2421637d5596661b4e2132cc.svg" color="#111" />


  <title>CodePen - formBuilder</title>
  
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css'>
  
<style>
body {
  padding: 0;
  margin: 10px 0;
  background: #f2f2f2 url('https://formbuilder.online/assets/img/noise.png');
}
</style>

  <script>
  window.console = window.console || function(t) {};
</script>

  
  
  <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>


</head>

<body translate="no" >
    
    <select name="models" id="models-select">
    <option value="">--Please choose a Model--</option>
    <?php foreach($models as $key=>$value){ ?>
    <option value="<?php echo $value; ?>" <?php if($_GET['model']==str_replace('.json','',$value)){echo 'selected="selected" disabled';} ?>><?php echo $value; ?></option>
    <?php } ?>
    </select><!-- comment -->
    --- Model Name <input type="text" name="new_model" id="new_model"></input><button type="submit" class="js-add-model">Create New Model</button>
    
  <div id="build-wrap"></div>

  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
<script src='https://formbuilder.online/assets/js/form-builder.min.js'></script>
      <script id="rendered-js" >
//# sourceURL=pen.js

jQuery(function($) {
    
  var $fbEditor = document.getElementById('build-wrap');
  var options = {
      onSave: function(evt, formData) {
          //formBuilder.actions.setData({formData});
          console.log(formData);
          $.ajax({
                type: "POST",
                url: "/index.php?mode=save&model=<?php echo $_GET['model'];?>",
                data: { data: formData},
                success: function(data){
                    alert('Your Model has Been Saved.');
                },
                failure: function(errMsg) {
                    alert('There Was a Problem Saving Your Model.');
                }
          });
        },
    };
    var formBuilder = $($fbEditor).formBuilder(options);
    <?php if(file_exists("models/".$_GET['model'].".json")){ ?>
    var formData = '<?php echo file_get_contents("models/".$_GET['model'].".json"); ?>';
    setTimeout(function(){ formBuilder.actions.setData(formData); }, 500);
    <?php } ?>
  
  document.addEventListener('fieldAdded', function(){
      console.log(formBuilder.formData);
      window.sessionStorage.setItem('formData', JSON.stringify(formBuilder.formData));
  });
  
  
  
    $('.js-add-model').on('click', function() {
        var model = $('#new_model').val();
        if(!model){
            alert('Model Can not be Empty');
        }
        
        top.location='?model='+model;
  });

  
  $('#models-select').on('change', function() {
        var model = this.value.replace('.json','');
        top.location='?model='+model;
  });

});
    </script>

  

</body>
</html>
