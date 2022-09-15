/*
 * Copyright (c) 2020 .
 */

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import '../../../models/payment_method.dart';
import '../controllers/checkout_controller.dart';
import '../../../../common/ui.dart';

class PaymentMethodItemWidget extends GetWidget<CheckoutController> {
  PaymentMethodItemWidget({
    @required PaymentMethod paymentMethod,
  }) : _paymentMethod = paymentMethod;

  final PaymentMethod _paymentMethod;

  @override
  Widget build(BuildContext context) {
    return Obx(() {
      return Container(
        margin: EdgeInsets.symmetric(horizontal: 20, vertical: 3),
        padding: EdgeInsets.symmetric(vertical: 10),
        decoration: Ui.getBoxDecoration(color: controller.getColor(_paymentMethod)),
        child: Theme(
          data: ThemeData(
            toggleableActiveColor: Get.theme.primaryColor,
          ),
          child: RadioListTile(
            value: _paymentMethod,
            groupValue: controller.selectedPaymentMethod.value,
            onChanged: (value) {
              controller.selectPaymentMethod(value);
            },
            title: Text(_paymentMethod.name, style: controller.getTitleTheme(_paymentMethod)).paddingOnly(bottom: 5),
            subtitle: Text(_paymentMethod.description, style: controller.getSubTitleTheme(_paymentMethod)),
            secondary: Container(
              height: 60,
              width: 60,
              decoration: BoxDecoration(
                borderRadius: BorderRadius.all(Radius.circular(5)),
                image: DecorationImage(image: AssetImage(_paymentMethod.logo), fit: BoxFit.fill),
              ),
            ),
          ),
        ),
      );
    });
  }
}