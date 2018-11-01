$(function(){

              var currentDate; // Holds the day clicked when adding a new event
              var currentEvent; // Holds the event object when editing an event
// Colopicker
              
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

              

              var base_url = 'https://ps.henkidama.com/'; // Here i define the base_url


              // Fullcalendar
              $('#calendar').fullCalendar({
                  monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                  monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
                  dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles','Jueves', 'Viernes', 'Sabado'],
                  dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                  header: {
                      left: 'prev, next, today',
                      center: 'title',
                      right: 'month, basicWeek, basicDay'
                  },
                  // Get all events stored in database
                  eventLimit: true, // allow "more" link when too many events
                  events: base_url+'/getActivities',
                  selectable: false,
                  selectHelper: true,
                  editable: false, // Make the event resizable true         
                     
                     
                    
                  // Event Mouseover
                  eventMouseover: function(calEvent, jsEvent, view){

                      var tooltip = '<div class="event-tooltip">' + calEvent.description + '</div>';
                      $("body").append(tooltip);

                      $(this).mouseover(function(e) {
                          $(this).css('z-index', 10000);
                          $('.event-tooltip').fadeIn('500');
                          $('.event-tooltip').fadeTo('10', 1.9);
                      }).mousemove(function(e) {
                          $('.event-tooltip').css('top', e.pageY + 10);
                          $('.event-tooltip').css('left', e.pageX + 20);
                      });
                  },
                  eventMouseout: function(calEvent, jsEvent) {
                      $(this).css('z-index', 8);
                      $('.event-tooltip').remove();
                  },
                  // Handle Existing Event Click
                  eventClick: function(calEvent, jsEvent, view) {
                      // Set currentEvent variable according to the event clicked in the calendar
                      var paramodal;
                      currentEvent = calEvent;

                      
                      paramodal = 
                      {
                        error: calEvent.description,
                        title: 'Actividad "' + calEvent.title,
                        event: calEvent,
                        mList: 0
                      };
                      // Open modal to edit or delete event
                      modal(paramodal);
                      
                  }

              });


              // Prepares the modal window according to data passed
              function modal(data) {
                  // Set modal title
                  var hyy = new Date();


                  var diae = data.event.start.getDate();
                  var mese = data.event.start.getMonth()+1;
                  var anoe = data.event.start.getFullYear();
                  var diaheyy = diae+"/"+mese+"/"+anoe;


                  $('#modal-title').html(data.title);
                  $('#error').html(data.error);
                  // Clear buttons except Cancel
                  $('#modal-footer button:not(".btn-default")').remove();
                  // Set input values   
                  $('#titledos').val(data.event ? data.event.title : '');        
                  $('#descriptiondos').val(data.event ? data.event.description : '');
                  $('#iniciodos').val(data.event ? data.event.inicio : '');
                  $('#fecha').val(data.event ? diaheyy : '');
                  $('#id_dos').val(data.event ? data.event.id : '');
                  //Show Modal
                  $('#modaldos').modal('show');
              }







              function hide_notify()
              {
                  setTimeout(function() {
                              $('.alert').removeClass('alert-success').text('');
                          }, 2000);
              }


              

          });


            $('#weekview').on('click', function() {
              $('.calendar').fullCalendar('changeView', 'agendaWeek')
            });

            $('#monthview').on('click', function() {
              $('.calendar').fullCalendar('changeView', 'month')
            });



