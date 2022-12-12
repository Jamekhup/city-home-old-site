
<footer class="footer">
    <div class="sms">
        <code>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a
        document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy
        is available.</code>
        
        <div class="contact">
            <small><a href="{{route('contact')}}">Contact Us</a> | <a href="">Contact Us on Facebook</a></small>
        </div>
        <hr>
    </div>
    
    <p>Company Register Number - #09383939</p>
    <p>2019 - <?php echo Date('Y'); ?> </p>
</footer>


<script src="https://kit.fontawesome.com/6079e6a874.js"></script>
<script src="{{asset('script/main.js')}}" defer></script>
<noscript>
    <style>
        html {
            display: none;
        }
    </style>
    <meta http-equiv="refresh" content="0.0;url=/">
</noscript>
@section('script')
@show