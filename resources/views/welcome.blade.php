<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>larajaxTodoList</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
   <!-- load jQuery -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- provide the csrf token -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
<nav class="bg-gray-800">
  <div class="">
    <div class=" flex items-center justify-between h-14">
      <div class="flex items-center sm:hidden">
        <!-- Mobile menu button-->
        <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
        </button>
      </div>
   
        <div class="hidden sm:block sm:ml-6">
          <div class="flex space-x-4">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <form action="{{ route('logout')}} " method="POST" class="inline">
                 @csrf
                <button type="submit" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium">Logout</button>
                </form>
            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Welcome {{auth()->user()->name}}</a>

      
          </div>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        <button class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
          <span class="sr-only">View notifications</span>
          <!-- Heroicon name: outline/bell -->
        </button>

        </div>
      </div>
    </div>
  </div>
</nav>
@if(auth()->user())
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<div class="flex flex-row mt-20 justify-center items-center font-semibold rounded-md shadow-sm">
<form  id="addItem">
    @csrf
    <input type="text" class="rounded-lg border-b-2 w-2/3 p-4 " name="body" id="body" placeholder="Add an item"/>
    <button type="submit" class="ml-5 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add</button>
 </form>
 </div>


        <div class=" bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
            <div class="w-5 lg:w-5/6">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto" id="itemtab">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">User</th>
                                <th class="py-3 px-6 text-left">Item</th>
                                <th class="py-3 px-6 text-left">Item_id</th>
                                <th class="py-3 px-6 text-center">Date</th>
                                <th class="py-3 px-6 text-center">Status</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                           @if($items->count())
                             @foreach($items as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="mr-2">
                                           {{auth()->user()->name}}
                                        </div>
                                    </div>
                                </td>
                          
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                      {{$item->body}}
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                      {{$item->id}}
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                  {{$item->created_at->toDateTimeString()}}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Active</span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    
                                              <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                </div>
                                        
                                        </div>
                                       
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                          @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<script>
$(document).ready(function(){
    $("#addItem").submit(function(e){
         e.preventDefault();
         let body = $("#body").val();
         let _token = $("input[name=_token]").val();
         $.ajax({
             url:"{{ route('item')}}",
             type:"POST",
             data:{
                 body:body,
                 _token:_token
             },
             success:function(response){
                 if(response){
                     let data=`
                     <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="mr-2">
                                           ${response.user}
                                        </div>
                                    </div>
                                </td>
                          
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">`+`
                                    ${response.body}
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">`+`
                                    ${response.id}
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                  ${response.date}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Active</span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    
                                              <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                </div>
                                               </button>
                                        
                                        </div>
                                       
                                    </div>
                                </td>
                            </tr>
                     `
                     $("#itemtab tbody").prepend(data);
                 }
             }
         });
     });

$('#itemtab').find('td').click( function(e){
e.preventDefault();
let num= ($(this).index()+1);
    if(num==6){
        let index = $(this).index('td')+1;
        let _token = $("input[name=_token]").val();
        let index_of_row = index / 6;
        let row = $('#itemtab').find('tr').eq(index_of_row);
        num = row.find("td:eq(2)").text();
        num = parseInt(num);
        var dltUrl ='item/'+num;
        $.ajax({
        url: dltUrl,
        type: 'DELETE', 
        dataType: "JSON",
        data: {
            "id": num,
            _token:_token
        },
        success: function (response)
        {
            let deletedIndex = index / 6;
            let row = $('#itemtab').find('tr').eq(deletedIndex);
            row.remove();
           
        },
        error: function(xhr) {
        console.log(xhr.responseText); 
        }
        });
    }
        
    });

    
});
    



</script>
@endif
</body>
</html>