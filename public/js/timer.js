/**
 * Created by Admin on 3/13/2020.
 */
var deadline = new Date("july 30, 2050 15:37:25").getTime();
var x = setInterval(function() {
    var currentTime = new Date().getTime();
    var t = deadline - currentTime;
    var days = Math.floor(t / (1000 * 60 * 60 * 24));
    var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60));
    var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((t % (1000 * 60)) / 1000);
    document.getElementById("hour").innerHTML =hours;
    document.getElementById("minute").innerHTML = minutes;
    document.getElementById("second").innerHTML =seconds;
    document.getElementById("hour1").innerHTML =hours;
    document.getElementById("minute1").innerHTML = minutes;
    document.getElementById("second1").innerHTML =seconds;
    document.getElementById("hour2").innerHTML =hours;
    document.getElementById("minute2").innerHTML = minutes;
    document.getElementById("second2").innerHTML =seconds;
    document.getElementById("hour3").innerHTML =hours;
    document.getElementById("minute3").innerHTML = minutes;
    document.getElementById("second3").innerHTML =seconds;
    document.getElementById("hour4").innerHTML =hours;
    document.getElementById("minute4").innerHTML = minutes;
    document.getElementById("second4").innerHTML =seconds;
    document.getElementById("hour5").innerHTML =hours;
    document.getElementById("minute5").innerHTML = minutes;
    document.getElementById("second5").innerHTML =seconds;
    document.getElementById("hour6").innerHTML =hours;
    document.getElementById("minute6").innerHTML = minutes;
    document.getElementById("second6").innerHTML =seconds;
    document.getElementById("hour7").innerHTML =hours;
    document.getElementById("minute7").innerHTML = minutes;
    document.getElementById("second7").innerHTML =seconds;
    document.getElementById("hour8").innerHTML =hours;
    document.getElementById("minute8").innerHTML = minutes;
    document.getElementById("second8").innerHTML =seconds;
    document.getElementById("hour9").innerHTML =hours;
    document.getElementById("minute9").innerHTML = minutes;
    document.getElementById("second9").innerHTML =seconds;
    document.getElementById("hour10").innerHTML =hours;
    document.getElementById("minute10").innerHTML = minutes;
    document.getElementById("second10").innerHTML =seconds;
    document.getElementById("hour11").innerHTML =hours;
    document.getElementById("minute11").innerHTML = minutes;
    document.getElementById("second11").innerHTML =seconds;
    document.getElementById("hour12").innerHTML =hours;
    document.getElementById("minute12").innerHTML = minutes;
    document.getElementById("second12").innerHTML =seconds;
    document.getElementById("hour13").innerHTML =hours;
    document.getElementById("minute13").innerHTML = minutes;
    document.getElementById("second13").innerHTML =seconds;
    document.getElementById("hour14").innerHTML =hours;
    document.getElementById("minute14").innerHTML = minutes;
    document.getElementById("second14").innerHTML =seconds;
    document.getElementById("hour15").innerHTML =hours;
    document.getElementById("minute15").innerHTML = minutes;
    document.getElementById("second15").innerHTML =seconds;
    document.getElementById("hour16").innerHTML =hours;
    document.getElementById("minute16").innerHTML = minutes;
    document.getElementById("second16").innerHTML =seconds;
    document.getElementById("hour17").innerHTML =hours;
    document.getElementById("minute17").innerHTML = minutes;
    document.getElementById("second17").innerHTML =seconds;
    document.getElementById("hour18").innerHTML =hours;
    document.getElementById("minute18").innerHTML = minutes;
    document.getElementById("second18").innerHTML =seconds;
    document.getElementById("hour19").innerHTML =hours;
    document.getElementById("minute19").innerHTML = minutes;
    document.getElementById("second19").innerHTML =seconds;
    document.getElementById("hour20").innerHTML =hours;
    document.getElementById("minute20").innerHTML = minutes;
    document.getElementById("second20").innerHTML =seconds;
    document.getElementById("hour21").innerHTML =hours;
    document.getElementById("minute21").innerHTML = minutes;
    document.getElementById("second21").innerHTML =seconds;
    document.getElementById("hour22").innerHTML =hours;
    document.getElementById("minute22").innerHTML = minutes;
    document.getElementById("second22").innerHTML =seconds;
    document.getElementById("hour23").innerHTML =hours;
    document.getElementById("minute23").innerHTML = minutes;
    document.getElementById("second23").innerHTML =seconds;
    document.getElementById("hour24").innerHTML =hours;
    document.getElementById("minute24").innerHTML = minutes;
    document.getElementById("second24").innerHTML =seconds;
    document.getElementById("hour25").innerHTML =hours;
    document.getElementById("minute25").innerHTML = minutes;
    document.getElementById("second25").innerHTML =seconds;
    document.getElementById("hour26").innerHTML =hours;
    document.getElementById("minute26").innerHTML = minutes;
    document.getElementById("second26").innerHTML =seconds;
    document.getElementById("hour27").innerHTML =hours;
    document.getElementById("minute27").innerHTML = minutes;
    document.getElementById("second27").innerHTML =seconds;
    document.getElementById("hour28").innerHTML =hours;
    document.getElementById("minute28").innerHTML = minutes;
    document.getElementById("second28").innerHTML =seconds;
    document.getElementById("hour29").innerHTML =hours;
    document.getElementById("minute29").innerHTML = minutes;
    document.getElementById("second29").innerHTML =seconds;
    document.getElementById("hour30").innerHTML =hours;
    document.getElementById("minute30").innerHTML = minutes;
    document.getElementById("second30").innerHTML =seconds;
    document.getElementById("hour31").innerHTML =hours;
    document.getElementById("minute31").innerHTML = minutes;
    document.getElementById("second31").innerHTML =seconds;




    if (t < 0) {
        clearInterval(x);
        document.getElementById("time-up").innerHTML = "TIME UP";
        document.getElementById("hour").innerHTML ='0';
        document.getElementById("minute").innerHTML ='0' ;
        document.getElementById("second").innerHTML = '0';

        document.getElementById("time-up1").innerHTML = "TIME UP";
        document.getElementById("hour1").innerHTML ='0';
        document.getElementById("minute1").innerHTML ='0' ;
        document.getElementById("second1").innerHTML = '0';

        document.getElementById("time-up2").innerHTML = "TIME UP";
        document.getElementById("hour2").innerHTML ='0';
        document.getElementById("minute2").innerHTML ='0' ;
        document.getElementById("second2").innerHTML = '0';

        document.getElementById("time-up3").innerHTML = "TIME UP";
        document.getElementById("hour3").innerHTML ='0';
        document.getElementById("minute3").innerHTML ='0' ;
        document.getElementById("second3").innerHTML = '0';

        document.getElementById("time-up4").innerHTML = "TIME UP";
        document.getElementById("hour4").innerHTML ='0';
        document.getElementById("minute4").innerHTML ='0' ;
        document.getElementById("second4").innerHTML = '0';

        document.getElementById("time-up5").innerHTML = "TIME UP";
        document.getElementById("hour5").innerHTML ='0';
        document.getElementById("minute5").innerHTML ='0' ;
        document.getElementById("second5").innerHTML = '0';

        document.getElementById("time-up6").innerHTML = "TIME UP";
        document.getElementById("hour6").innerHTML ='0';
        document.getElementById("minute6").innerHTML ='0' ;
        document.getElementById("second6").innerHTML = '0';

        document.getElementById("time-up7").innerHTML = "TIME UP";
        document.getElementById("hour7").innerHTML ='0';
        document.getElementById("minute7").innerHTML ='0' ;
        document.getElementById("second7").innerHTML = '0';

        document.getElementById("time-up8").innerHTML = "TIME UP";
        document.getElementById("hour8").innerHTML ='0';
        document.getElementById("minute8").innerHTML ='0' ;
        document.getElementById("second8").innerHTML = '0';

        document.getElementById("time-up9").innerHTML = "TIME UP";
        document.getElementById("hour9").innerHTML ='0';
        document.getElementById("minute9").innerHTML ='0' ;
        document.getElementById("second9").innerHTML = '0';

        document.getElementById("time-up10").innerHTML = "TIME UP";
        document.getElementById("hour10").innerHTML ='0';
        document.getElementById("minute10").innerHTML ='0' ;
        document.getElementById("second10").innerHTML = '0';

        document.getElementById("time-up11").innerHTML = "TIME UP";
        document.getElementById("hour11").innerHTML ='0';
        document.getElementById("minute11").innerHTML ='0' ;
        document.getElementById("second11").innerHTML = '0';

        document.getElementById("time-up12").innerHTML = "TIME UP";
        document.getElementById("hour12").innerHTML ='0';
        document.getElementById("minute12").innerHTML ='0' ;
        document.getElementById("second12").innerHTML = '0';

        document.getElementById("time-up13").innerHTML = "TIME UP";
        document.getElementById("hour13").innerHTML ='0';
        document.getElementById("minute13").innerHTML ='0' ;
        document.getElementById("second13").innerHTML = '0';

        document.getElementById("time-up14").innerHTML = "TIME UP";
        document.getElementById("hour14").innerHTML ='0';
        document.getElementById("minute14").innerHTML ='0' ;
        document.getElementById("second14").innerHTML = '0';

        document.getElementById("time-up15").innerHTML = "TIME UP";
        document.getElementById("hour15").innerHTML ='0';
        document.getElementById("minute15").innerHTML ='0' ;
        document.getElementById("second15").innerHTML = '0';

        document.getElementById("time-up16").innerHTML = "TIME UP";
        document.getElementById("hour16").innerHTML ='0';
        document.getElementById("minute16").innerHTML ='0' ;
        document.getElementById("second16").innerHTML = '0';

        document.getElementById("time-up17").innerHTML = "TIME UP";
        document.getElementById("hour17").innerHTML ='0';
        document.getElementById("minute17").innerHTML ='0' ;
        document.getElementById("second17").innerHTML = '0';

        document.getElementById("time-up18").innerHTML = "TIME UP";
        document.getElementById("hour18").innerHTML ='0';
        document.getElementById("minute18").innerHTML ='0' ;
        document.getElementById("second18").innerHTML = '0';

        document.getElementById("time-up19").innerHTML = "TIME UP";
        document.getElementById("hour19").innerHTML ='0';
        document.getElementById("minute19").innerHTML ='0' ;
        document.getElementById("second19").innerHTML = '0';

        document.getElementById("time-up20").innerHTML = "TIME UP";
        document.getElementById("hour20").innerHTML ='0';
        document.getElementById("minute20").innerHTML ='0' ;
        document.getElementById("second20").innerHTML = '0';

        document.getElementById("time-up21").innerHTML = "TIME UP";
        document.getElementById("hour21").innerHTML ='0';
        document.getElementById("minute21").innerHTML ='0' ;
        document.getElementById("second21").innerHTML = '0';

        document.getElementById("time-up22").innerHTML = "TIME UP";
        document.getElementById("hour22").innerHTML ='0';
        document.getElementById("minute22").innerHTML ='0' ;
        document.getElementById("second22").innerHTML = '0';

        document.getElementById("time-up23").innerHTML = "TIME UP";
        document.getElementById("hour23").innerHTML ='0';
        document.getElementById("minute23").innerHTML ='0' ;
        document.getElementById("second23").innerHTML = '0';


    }
}, 1000);
