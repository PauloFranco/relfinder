<style>

/*Remove that CSS*/
.col-md-3 {
    margin-left:5%;
    }
/*Remove that CSS*/



button {
  margin: 20px 0;
  line-height: 34px;
  position: relative;
  cursor: pointer;
  user-select: none;
  outline:none !important;
  width:100%;
}

button:active {

  outline:none;
}

button.ribbon {

  outline:none;
  outline-color: transparent;
}
button.ribbon:before, button.ribbon:after {
  top: 5px;
  z-index: -10;
}
button.ribbon:before {
  border-color: #53dab6 #53dab6 #53dab6 transparent;
  left: -25px;
  border-width: 17px;
}
button.ribbon:after {
  border-color: #53dab6 transparent #53dab6 #53dab6;
  right: -25px;
  border-width: 17px;
}

button:before, button:after {
  content: '';
  position: absolute;
  height: 0;
  width: 0;
  border-style: solid;
  border-width: 0;
  outline:none;
}

button.btn-default:before {
  border-color: #757575 #757575 #757575 transparent;
    }
    button.btn-default:after {
  border-color: #757575 transparent #757575 #757575;
    }



    button.btn-primary:before {
  border-color: #2e6da4 #2e6da4 #2e6da4 transparent;
    }
    button.btn-primary:after {
  border-color: #2e6da4 transparent #2e6da4 #2e6da4;
    }


    button.btn-success:before {
  border-color: #398439 #398439 #398439 transparent;
    }
    button.btn-success:after {
  border-color: #398439 transparent #398439 #398439;
    }


    button.btn-info:before {
  border-color: #269abc #269abc #269abc transparent;
    }
    button.btn-info:after {
  border-color: #269abc transparent #269abc #269abc;
    }


    button.btn-warning:before {
  border-color: #d58512 #d58512 #d58512 transparent;
    }
    button.btn-warning:after {
  border-color: #d58512 transparent #d58512 #d58512;
    }


    button.btn-danger:before {
  border-color: #ac2925 #ac2925 #ac2925 transparent;
    }
    button.btn-danger:after {
  border-color: #ac2925 transparent #ac2925 #ac2925;
    }


</style>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>QuizaRd</title>

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/logo-nav.css" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="http://placehold.it/150x50&text=QuizaRd" alt="">
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li><a href="#">Descubra respostas para perguntas que nunca imaginou fazer</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">
	<div class="row">
    <img src="logo.png" alt="Mountain View" style="width:304px;height:228px;">
		<h2 style="text-align:center">Escolha uma categoria</h2>
	</div>

    <div class="row">


  <div class="col-md-12 ">       <!-- Standard button -->
<button type="button" class="btn btn-default ribbon">Geral</button>

<!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
<button onclick="location.href = 'http://127.0.0.1/edsa-WebDev/relfinder/example/quizard.php'" type="button" class="btn btn-primary ribbon">Filmes</button>

<!-- Indicates a successful or positive action -->
<button type="button" class="btn btn-success ribbon">História</button>

<!-- Contextual button for informational alert messages -->
<button type="button" class="btn btn-info ribbon">Ciência</button>

<!-- Indicates caution should be taken with this action -->
<button type="button" class="btn btn-warning ribbon">Música</button>

<!-- Indicates a dangerous or potentially negative action -->
<button type="button" class="btn btn-danger ribbon">Geografia</button>

<!-- Deemphasize a button by making it look like a link while maintaining button behavior -->
</div>




    </div>


</div>

<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){
$('#info').hide();
});

$(function(){
var loading = $('#loadbar').hide();
$(document)
.ajaxStart(function () {
    loading.show();
}).ajaxStop(function () {
  loading.hide();
});

$("label.btn").on('click',function () {
  var choice = $(this).find('input:radio').val();
  $('#loadbar').show();
  $('#quiz').fadeOut();
  setTimeout(function(){
       $( "#answer" ).html(  $(this).checking(choice) );
        $('#quiz').show();
        $('#loadbar').fadeOut();
       /* something else */
  }, 1500);
});

$ans = 3;

$.fn.checking = function(ck) {
    if (ck != $ans){
        $('#info').hide();
        return 'INCORRETO';
    }else{
        $('#info').show();
        return 'CORRETO';
      }
};
});

</script>

</body>
