<html>
    <head>
        <title></title>
    </head>
    <body>
        <table border="1px">
            <tr>
                <th>view</th>
            </tr>
            @foreach($data as $data)
            
            <tr>
                <td><a href="{{url('/view',$data->id)}}">view</a></td>
            </tr>
      
        @endforeach
        </table>
    </body>
</html>