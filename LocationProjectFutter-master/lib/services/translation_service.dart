import 'package:flutter/cupertino.dart';
import 'package:get/get.dart';
import 'package:location_specialist/helpers/static/file_handler.dart';

class TranslationService extends GetxService {
  final translations = Map<String, Map<String, String>>().obs;
  // fallbackLocale saves the day when the locale gets in trouble
  final fallbackLocale = Locale('ru', 'RU');

  // must add language codes here
  static TranslationService get service => Get.find<TranslationService>();
  static final languages = [
    'ru',
    'uz',
    'en',
  ];

  // initialize the translation service by loading the assets/locales folder
  // the assets/locales folder must contains file for each language that named
  // with the code of language concatenate with the country code
  // for example (en_US.json)
  Future<TranslationService> init() async {
    languages.forEach((lang) async {
      var _file = await FileHandler.getJsonFile('assets/locale/$lang.json');
      translations.putIfAbsent(lang, () => Map<String, String>.from(_file));
    });
    return this;
  }

  // get list of supported locale in the application
  List<Locale> supportedLocales() {
    return TranslationService.languages.map((_locale) {
      return fromStringToLocale(_locale);
    }).toList();
  }

  // Convert string code to locale object
  Locale fromStringToLocale(String _locale) {
    if (_locale.contains('_')) {
      // en_US
      return Locale(
          _locale.split('_').elementAt(0), _locale.split('_').elementAt(1));
    } else {
      // en
      return Locale(_locale);
    }
  }
}
