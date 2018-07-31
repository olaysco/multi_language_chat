/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    
    //to change size of image on dashboard page
    if($(window).width()>760){
       img_height = $('body').height()-$('#wrapper > nav').height()*4.84;
       $('.home-img').height(img_height).css('margin-bottom',0);
       
       //alert($(window).width()+ '   '+img_height);
   } 
   else if($(window).width()<480){
       //img_height = $('body').height()-$('#wrapper > nav').height()*4.84;
       $('.home-img').height(img_height).css('margin-bottom',0);
   }
   
   
   
   
        $('#dataTables-example').DataTable({
                responsive: true
        });
        
        showCharts();
        
        $('#performanceRanking').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    });
    
    //for alert notification
    width = $('.row').width()+'px';
    
    console.log(width);
    var scroll = $(window).scroll(function(){
        var margin = $('.navbar').height() - $(window).scrollTop();
        width = $('#alert-container').parent().width()+'px';
        
        if($(window).scrollTop()> $('.navbar').height()  ){
             $('#alert-container').css('margin-top',-$('.navbar').height());
            $('#alert-container').css({'position':'fixed','width':width});
            
            
            
        } 
        else {
             
            $('#alert-container').css({'margin-top':margin-$('.navbar').height(),'postion':'relative'}  ); 
            
        }
          
    });scroll;
    //end alert notification function
    //$('.myAlert').addClass('hidden');
        
    });
$(function(){
	$('tbody').on('click','.ca1, .ca2, .ca3, .exam', function(){
		displayForm($(this));
		
});
});

// ajax section, for performing ajax load
//$(function(){
//    $("a[rel='tab']").click(function(e){
//      e.preventDefault();
//      pageurl = $(this).attr('href').slice(9);
//      str = pageurl.indexOf('=');
//      
//      nxt = (pageurl.indexOf('&&')<1)?pageurl.length:pageurl.indexOf('&&');
//      page = pageurl.substring(str+1,nxt);
//      header_string = (pageurl.indexOf('&&')<1)?''+'via=ajax':(pageurl.substring(pageurl.indexOf('&&')+2,pageurl.length)+'&&via=ajax');
////      console.log(pageurl);
////      console.log(header_string);
////      console.log(page);
//      goto_pages = ["pages/compute.php","pages/student.php","pages/charts.php","pages/profile.php","pages/home.php","pages/preferences.php","pages/generate.php"];
//      expected_pages = ["compute_result","students","performance_charts","profile","home","preferences","generate"];
//      url = goto_pages[expected_pages.indexOf(page)]+'?'+header_string;
//     
//      $.ajax({url:url, success:function(data){
//              $('#content-div').html(data);
//              if(page==='performance_charts'){
//                  showCharts();
//              }
//               console.log(url+'&&via=ajax');
//              //console.log(data);
//      }});
//  
//    });
//});

function displayForm(cell){
	var column = cell.attr('class'),	
	id = cell.closest('tr').attr('class'),
        //type = cell.closest('tr').attr('id'),
	cellWidth = cell.css('width'),
	prevContent = cell.text(),
	
	form = '<form action = "javascript: 		    this.preventDefault"><input type="text" max="100" min="0" name="newValue" value="'+prevContent+'" /><input type="hidden" name="id" value="'+id+'" />'+'<input type="hidden" name="column" value="'+column+'" /></form>';
	
	
	cell.html(form).find('input[type=text]')
	.focus()
	
	.css('width', cellWidth);
	cell.on('click', function(){ return false;});
	cell.find('input[type=text]').blur(function(){
		cell.text(prevContent);
	cell.off('click');
	});
	cell.on('keydown', function(e){ 
	
	if(e.keyCode == 13){
	
	changeField(cell, prevContent,id);
        
	}else if (e.keyCode == 27){
	cell.text(prevContent);
	cell.off('click');
	}
	
	});
}


function changeField(cell, prevContent,id){
	
	cell.off('keydown');
	
	var url = 'includes/ajax.php?result&',
	input = cell.find('form').serialize();
	var jqXHR = $.getJSON(url+input, function(data)	{
            console.log(data);
	if(data.success){
	cell.html(data.value);
	$('#alert-container').append('<div class="alert alert-success alert-dismissable myAlert">'+
                                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
                               ' the operation was successful </div> ');
	 }
	else{
		alert(data.error);
		cell.html(prevContent);
		$('#alert-container').append('<div class="alert alert-danger alert-dismissable myAlert">'+
                                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
                               ' the operation was not successful, please try again after sometime </div> ');
	}
        
	})
        .done(function() { console.log( "second success" ); })
        .fail(function() { console.log( "error" ); alert('an error occured'); })
        .always(function() { console.log( "complete" ); updateTotal(id);});
        
        
        
	cell.off('click');
        
	cell.off('click');
}

function updateTotal(id){
    

    
    
    ca1 = new Number($('.'+id+' > td.ca1').html());
    ca2 = new Number($('.'+id+' > td.ca2').html());
    ca3 = new Number($('.'+id+' > td.ca3').html());
    
    exam = new Number($('.'+id+' > td.exam').html());
    total = ca1+ca2+ca3+exam;
    $('.'+id+' > td.total').html(total);
    console.log(ca1+ca2+ca3+exam);
}
	



//Flot Pie Chart


   

        



function showCharts(){
    
            var url = 'includes/ajax.php?charts';
        var response;
    $.getJSON(url, function(res)	{  
         response = res;
         
    
    
    var data = response;

    var plotObj = $.plot($("#flot-pie-chart"), data, {
        series: {
            pie: {
                show: true
            }
        },
        grid: {
            hoverable: true
        },
        tooltip: true,
        tooltipOpts: {
            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
            shifts: {
                x: 20,
                y: 0
            },
            defaultTheme: true
        }
    });

});
};