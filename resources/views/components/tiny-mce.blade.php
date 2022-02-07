<editor
    v-model="{{$vmodel}}"
    api-key="ebh6ebv0erdyq8k562jsehocpgtkvot74a9408p8wboo1gww"
    :init="{
        height: {{$height}},
        max_height: {{$height}},
        skin: false,
        statusbar: false,
        menubar: false,
        plugins: [
          'advlist  lists charmap  preview anchor',
          'visualblocks',
          'insertdatetime media table paste wordcount'
        ],
        toolbar:
          'undo redo  | forecolor backcolor bold italic  | \
          alignleft aligncenter alignright alignjustify | \
          bullist numlist outdent indent | removeformat'
    }"
/>
