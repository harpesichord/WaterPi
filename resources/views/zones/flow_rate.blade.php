<tr>
    <input name="flowRatesID[]" value="{{ $rate["flowRatesID"] or "-1" }}" type="hidden"/>
    <td class="col-sm-1"><btn class="table-link removeTableRow" title="Remove Flow Rate"><span class="glyphicon tableglyph glyphicon-remove-circle" aria-hidden="true"></span></btn></td>    
    <td><input class="form-control form_text_field flowRate diameter" name="diameter[]" placeholder="Nozzel Diameter (inches)" value="{{ $rate['diameter'] or ''}}" type="text" required/></td>
    <td><input class="form-control form_text_field flowRate pressure" name="pressure[]" placeholder="Water Pressure (psi)" value="{{ $rate['pressure'] or ''}}" type="text" required/></td>
    <td><input class="form-control form_text_field flowRate quantity" name="quantity[]" placeholder="Head Quantity" value="{{ $rate['quantity'] or ''}}" type="text" required/></td>
</tr>