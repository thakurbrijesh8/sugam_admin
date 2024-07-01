<tr>
    <td style="width: 30px;" class="text-center v-a-m f-w-b">{{temp_cnt}}</td>
    <td class="text-center">{{barcode_number}}</td>
    <td class="text-center">{{generated_datetime_text}}</td>
    <td class="text-center">
        <button class="btn btn-xs btn-info" title="View Copy" 
                onclick="downloadCopy(VALUE_ONE,{{form_copy_id}})"><i class="fas fa-eye"></i></button>
        <button class="btn btn-xs btn-nic-blue" title="Download Copy" 
                onclick="downloadCopy(VALUE_TWO,{{form_copy_id}})"><i class="fas fa-download"></i></button>
    </td>
</tr>