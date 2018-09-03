
<?php
include 'class/func.php';
$api_url     = 'https://www.google.com/recaptcha/api/siteverify';
$site_key    = '6LfxSD4UAAAAANwSCdH3WMH_PbU5hhzzrYZfsnCS';
$secret_key  = '6LfxSD4UAAAAAFba9X1hqPsM3pnGMNqaYU6jzuNa';
if(isset($_POST['submit']))
{
    $site_key_post    = $_POST['g-recaptcha-response'];
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $remoteip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $remoteip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $remoteip = $_SERVER['REMOTE_ADDR'];
    }
    $api_url = $api_url.'?secret='.$secret_key.'&response='.$site_key_post.'&remoteip='.$remoteip;
    $response = file_get_contents($api_url);
    $response = json_decode($response);
    if(!isset($response->success))
    {
        header('Location: '.url.'/?error=3');
    }
    if($response->success == true)
    {
        if($_POST['user'] != null && $_POST['pass'] != null){
            $u = addslashes($_POST['user']);
            $p = md5(addslashes($_POST['pass']));
            $auth_access = $mysql->where('username', $u)->where('password', $p)->get('employer');

            if($mysql->num_rows() > 0){
              $token = getToken(64);
              setcookie('is_login', true, time()+ (86400 * 90), '/');
              setcookie('id', $u, time()+ (86400 * 90), '/');
              setcookie('verify', base64_encode($p), time()+ (86400 * 90), '/');
              setcookie('token', $token, time()+ (86400 * 90), '/');
              $mysql->where('username', $u)->where('password', $p)->update('employer', array('token' => $token));
              $mysql->insert('access_log', array(
                'ip' => $_SERVER['REMOTE_ADDR'], 
                'head' => $_SERVER['HTTP_REFERER'], 
                'user' => $auth_access[0]['id'], 
                'ua' => $_SERVER['HTTP_USER_AGENT']
                ));
              /**
              session_start();
              $_SESSION['id'] = $auth_access[0]['id'];
              $_SESSION['name'] = $auth_access[0]['employer'];
              $_SESSION['permision'] = $auth_access[0]['permision'];
              $_SESSION['code'] = $auth_access[0]['code'];
              $_SESSION['leader'] = $auth_access[0]['leader'];
              $_SESSION['pro'] = $auth_access[0]['pro'];
              $_SESSION['phone'] = $auth_access[0]['phone'];
              **/

              header('Location: '.url);
              
            } else {
              header('Location: '.url.'/?error=1');
            }
      }

    }else{
        header('Location: '.url.'/?error=2');
    }
}

if(isset($_GET['logout'])){
  setcookie('is_login', false, time() - (86400 * 90));
  setcookie('id', null, time()- (86400 * 90), '/');
  setcookie('verify', null, time()- (86400 * 90), '/');
  setcookie('token', null, time()- (86400 * 90), '/');
  /**
  session_start();
  $_SESSION['id'] = null;
  $_SESSION['name'] = null;
  $_SESSION['permision'] = null;
  $_SESSION['code'] = null;
  $_SESSION['leader'] = null;
  $_SESSION['pro'] = null;
  $_SESSION['phone'] = null;
  session_destroy();
  **/
  header('Location: '.url);
}

function crypto_rand_secure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}

function getToken($length)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
    }

    return $token;
}
?>
<!DOCTYPE html>
<html>
    
<!-- Mirrored from coderthemes.com/minton/dark/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2005], Fri, 24 Aug 2018 17:25:06 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="<?php echo style; ?>/assets/images/favicon.ico">

        <title>Minton - Responsive Admin Dashboard Template</title>

        <link href="<?php echo style; ?>/assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <link href="<?php echo style; ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo style; ?>/assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="<?php echo style; ?>/assets/css/style.css" rel="stylesheet" type="text/css">

        <script src="<?php echo style; ?>/assets/js/modernizr.min.js"></script>

    </head>
    <body>

        <div class="wrapper-page">

            <div class="text-center">
                <a href="index-2.html" class="logo-lg"><i class="mdi mdi-radar"></i> <span>HaiAnhGroup</span> </a>
            </div>

            <form class="form-horizontal m-t-20" action="http://coderthemes.com/minton/dark/index.html">

                <div class="form-group row">
                    <div class="col-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-account"></i></span>
                            </div>
                            <input class="form-control" type="text" required="" placeholder="Tên đăng nhập">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-key"></i></span>
                            </div>
                            <input class="form-control" type="password" required="" placeholder="Mật khẩu">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" type="checkbox">
                            <label for="checkbox-signup">
                                Ghi nhớ
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group text-right m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-custom w-md waves-effect waves-light" type="submit">Đăng nhập
                        </button>
                    </div>
                </div>

                <div class="form-group row m-t-30">
                    <div class="col-sm-7">
                        <a href="pages-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your
                            password?</a>
                    </div>
                    <div class="col-sm-5 text-right">
                        <a href="pages-register.html" class="text-muted"></a>
                    </div>
                </div>
            </form>
        </div>


        <script>
            var resizefunc = [];
        </script>

        <!-- Plugins  -->
        <script src="<?php echo style; ?>/assets/js/jquery.min.js"></script>
        <script src="<?php echo style; ?>/assets/js/popper.min.js"></script><!-- Popper for Bootstrap -->
        <script src="<?php echo style; ?>/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo style; ?>/assets/js/detect.js"></script>
        <script src="<?php echo style; ?>/assets/js/fastclick.js"></script>
        <script src="<?php echo style; ?>/assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo style; ?>/assets/js/jquery.blockUI.js"></script>
        <script src="<?php echo style; ?>/assets/js/waves.js"></script>
        <script src="<?php echo style; ?>/assets/js/wow.min.js"></script>
        <script src="<?php echo style; ?>/assets/js/jquery.nicescroll.js"></script>
        <script src="<?php echo style; ?>/assets/js/jquery.scrollTo.min.js"></script>
        <script src="<?php echo style; ?>/assets/plugins/switchery/switchery.min.js"></script>

        <!-- Custom main Js -->
        <script src="<?php echo style; ?>/assets/js/jquery.core.js"></script>
        <script src="<?php echo style; ?>/assets/js/jquery.app.js"></script>
	
	</body>

<!-- Mirrored from coderthemes.com/minton/dark/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2005], Fri, 24 Aug 2018 17:25:06 GMT -->
</html>