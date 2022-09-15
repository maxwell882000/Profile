import 'package:flutter/services.dart';

class DatePaymentFormatter extends TextInputFormatter {
  @override
  TextEditingValue formatEditUpdate(
      TextEditingValue oldValue, TextEditingValue newValue) {
    String text = newValue.text.replaceAll('/', "");
    if (newValue.selection.baseOffset == 0) {
      return newValue;
    }
    StringBuffer buffer = new StringBuffer();
    List.generate(text.length, (index) {
      buffer.write(text[index]);
      int limit = index + 1;
      if (limit % 2 == 0 && limit != text.length) {
        buffer.write('/');
      }
    });
    String newText = buffer.toString();
    return newValue.copyWith(
        text: newText,
        selection: new TextSelection.collapsed(offset: newText.length));
  }
}
