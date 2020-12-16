<div class="right-sidebar">
    <div class="slimscrollright">
        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle "></i></span></div>
        <div class="r-panel-body">
            <ul class="m-t-20 chatonline">
                <li class="d-block"><i class="fa fa-language text-info"></i> <b>Language</b></li>
                <li>
                    <a href="javascript:void(0)" class="p-1" onclick="locale('ar')"><small>Arabic</small> </a>
                    <a href="javascript:void(0)" class="p-1" onclick="locale('en')"><small>English</small> </a>
                </li>

                <li class="d-block"><i class="fa fa-themeisle text-info"></i> <b>Theme</b></li>
                <li>
                    <a href="javascript:void(0)" class="p-1" onclick="theme('dark')"><small>Dark</small></a>
                    <a href="javascript:void(0)" class="p-1" onclick="theme('light')"><small>Light</small></a>
{{--                    <a href="javascript:void(0)" class="p-1" onclick="theme('rtl')"><small>RTL</small></a>--}}
                </li>

            </ul>
            <ul id="themecolors">
                <li class="m-t-30"><b>With Light sidebar</b></li>

                <li><a href="javascript:void(0)" data-skin="skin-default" class="default-theme {{$skin==='skin-default'?'working':''}}" onclick="skin('skin-default')">1</a></li>
                <li><a href="javascript:void(0)" data-skin="skin-green" class="green-theme {{$skin==='skin-green'?'working':''}}" onclick="skin('skin-green')">2</a></li>
                <li><a href="javascript:void(0)" data-skin="skin-red" class="red-theme {{$skin==='skin-red'?'working':''}}" onclick="skin('skin-red')">3</a></li>
                <li><a href="javascript:void(0)" data-skin="skin-blue" class="blue-theme {{$skin==='skin-blue'?'working':''}}" onclick="skin('skin-blue')">4</a></li>
                <li><a href="javascript:void(0)" data-skin="skin-purple" class="purple-theme {{$skin==='skin-purple'?'working':''}}" onclick="skin('skin-purple')">5</a></li>
                <li><a href="javascript:void(0)" data-skin="skin-megna" class="megna-theme {{$skin==='skin-megna'?'working':''}}" onclick="skin('skin-megna')">6</a></li>

                <li class="d-block m-t-20"><b>With Dark sidebar</b></li>

                <li><a href="javascript:void(0)" data-skin="skin-default-dark" class="default-dark-theme {{$skin==='skin-default-dark'?'working':''}}" onclick="skin('skin-default-dark')">7</a></li>
                <li><a href="javascript:void(0)" data-skin="skin-green-dark" class="green-dark-theme {{$skin==='skin-green-dark'?'working':''}}" onclick="skin('skin-green-dark')">8</a></li>
                <li><a href="javascript:void(0)" data-skin="skin-red-dark" class="red-dark-theme {{$skin==='skin-red-dark'?'working':''}}" onclick="skin('skin-red-dark')">9</a></li>
                <li><a href="javascript:void(0)" data-skin="skin-blue-dark" class="blue-dark-theme {{$skin==='skin-blue-dark'?'working':''}}" onclick="skin('skin-blue-dark')">10</a></li>
                <li><a href="javascript:void(0)" data-skin="skin-purple-dark" class="purple-dark-theme {{$skin==='skin-purple-dark'?'working':''}}" onclick="skin('skin-purple-dark')">11</a></li>
                <li><a href="javascript:void(0)" data-skin="skin-megna-dark" class="megna-dark-theme {{$skin==='skin-megna-dark'?'working':''}}" onclick="skin('skin-megna-dark')">12</a></li>
            </ul>

        </div>
    </div>
</div>

<script>
   function skin(skin){
       axios.put('/setting/1', {'name':'skin', 'value':skin});
    }
    function theme(theme) {
        axios.put('/setting/2', {'name':'theme', 'value':theme}).then(resp=>window.location.reload());
    }
    function locale(locale) {
        axios.put('/setting/3', {'name':'locale', 'value':locale}).then(resp=>window.location.reload());
    }
</script>