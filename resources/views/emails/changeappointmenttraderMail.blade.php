<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Appointment</title>
</head>
<body style="background: #f1f1f1;">

    <div style="width: 670px;margin: auto;">
        <div style="width: 670px;float: left; background: #E6E6E6;">
        
            <!-- header -->
            <div style="width: 670px;float: left; background: #FFF;padding: 15px;">
                <div style="float: left;"><img src="{{ asset('ui/email/images/Logo.png') }}" alt="logo"></div>
                <div style="float: right;padding-top: 18px;">
                    <a href="https://www.facebook.com/" target="_blank"><img src="{{ asset('ui/email/images/facebook.png') }}" alt=""></a>
                    <a href="https://www.twitter.com/" target="_blank"><img src="{{ asset('ui/email/images/twitter.png') }}" alt=""></a>
                    <a href="https://www.instagram.com/" target="_blank"><img src="{{ asset('ui/email/images/instagram.png') }}" alt=""></a>
                    <a href="https://www.google.com/" target="_blank"><img src="{{ asset('ui/email/images/google-plus.png') }}" alt=""></a>
                </div>
            </div>
            <!-- header -->
            <!-- content area -->
            <div style="width: 670px;padding: 33px 15px; float: left; background-image: url({{ asset('ui/email/images/bg.png') }}); background-repeat: repeat-x; background-position: left top;">
                <div style="width: 640px;float: left;background: #FFF;padding: 15px; border-radius: 6px;margin-bottom: 10px;">
                    <div style="width: 100%;text-align: center;font-size: 20px;color: #231F20; font-weight: bold;font-family: Arial, Helvetica, sans-serif;margin-bottom: 5px;">Welcome to Uno Traders</div>
                    <!-- <div style="width: 100%;text-align: center;font-size: 14px;color: #575757; font-weight: normal;font-family: Arial, Helvetica, sans-serif;margin-bottom: 5px;">Lorem Ipsum is simply dummy text of the printing and</div> -->
                    <div style="width: 100%;float: left;padding-top: 20px;">
                        <div style="width: 100%;float: left;font-family: Arial, Helvetica, sans-serif;color: #231F20;font-size: 18px;font-weight: bold;margin-bottom: 10px;">Dear {{ $changeappointment['customer'] }},</div>
                        <br/>
                        <div style="width: 100%;float: left;font-family: Arial, Helvetica, sans-serif;color: #231F20;font-size: 14px;font-weight: normal;line-height: 24px;">Your appointment request to {{ $changeappointment['trader'] }} has been {{ $changeappointment['status'] }}.
                        </div>
                        <br/>
                        <br/>
                        <div style="width: 100%;float: left;font-family: Arial, Helvetica, sans-serif;color: #231F20;font-size: 14px;font-weight: normal;line-height: 24px;">Remarks:{{ $changeappointment['remarks'] }}
                        </div>
                        <br/>
                        <div style="width: 100%;float: left;font-family: Arial, Helvetica, sans-serif;color: #231F20;font-size: 14px;font-weight: normal;line-height: 24px;">Please visit your profile for more details.
                        </div>
                    </div>
                </div>
                <div style="width: 640px;float: left;background: #231F20;padding: 15px; border-radius: 6px;margin-bottom: 10px;">
                    <div style="width: 100%;text-align: center;font-size: 15px;color: #FFF; font-weight: bold;font-family: Arial, Helvetica, sans-serif;margin-bottom: 5px;">Need more help?</div>
                    <div style="width: 100%;text-align: center;font-size: 12px;color: #FFF; font-weight: bold;font-family: Arial, Helvetica, sans-serif;margin-bottom: 5px;text-decoration: underline;"><a style="color: #FFF;" href="{{ route('ui-home') }}">We're here ready to talk</a></div>
                </div>
            </div>
            <!-- content area close-->
            <!-- footer area -->
            <div style="width: 670px;float: left;padding: 20px 15px;background: #FFF;font-size: 13px;font-family: Arial, Helvetica, sans-serif;text-align: center;text-decoration: none;">
                <a style="padding-left: 5px;padding-right: 5px;" href="{{ route('about-us') }}">About Us</a>
                <a style="padding-left: 5px;padding-right: 5px;" href="{{ route('contact-us') }}">Contact Us</a>
                <a style="padding-left: 5px;padding-right: 5px;" href="{{ route('privacy-policy') }}">Privacy Policy</a>
                <a style="padding-left: 5px;padding-right: 5px;" href="{{ route('terms-and-conditions') }}">Terms & Conditions</a>
            </div>
            <!-- footer area close-->
        
        </div>
    </div>

</body>
</html>