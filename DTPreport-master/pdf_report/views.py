from random import random

from django.http import FileResponse, JsonResponse, HttpResponse
from django.views.generic import View
import os

from flask_qrcode import QRcode

from DTPreport import settings as s
from makereport.models import Report, Documents, Contract, Calculation, \
    HoldsImages, TemplateBase, TemplateMixing, TemplateAgreement, TemplateAdditional, Enumeration, Closing

from pdf_report.utils import PyPDFML, generate_pdf, get_name, check_qr_code

from django.core.files.base import ContentFile

import locale
import base64
import jinja2


def get_base_additional_template(request):
    try:
        file = TemplateAdditional.objects.last().template
    except:
        file = None
    name = 'report.html'
    return handle_schema(file=file, default_name=name)


def get_base_template(request):
    try:
        file = TemplateBase.objects.last().template
    except:
        file = None
    name = 'report.html'
    return handle_schema(file=file, default_name=name)


def get_base_mixing_template(request):
    try:
        file = TemplateMixing.objects.last().template
    except:
        file = None
    name = 'finishing_report.html'
    return handle_schema(file=file, default_name=name)


def get_base_agreement_template(request):
    try:
        file = TemplateAgreement.objects.last().template
    except:
        file = None
    name = 'aggreement_report.html'
    return handle_schema(file=file, default_name=name)


def handle_schema(file, default_name):
    try:
        file_data = open(file.path, 'rb')
        return get_file_path(file=file_data, name=file.name)
    except:
        file_data = open(
            os.path.abspath(os.path.join(s.MEDIA_ROOT, '../templates/template_html/{}'.format(default_name))), 'rb')
        return get_file_path(file=file_data, name=default_name)


def get_file_path(file, name="", content_type='text/xml'):
    response = FileResponse(file,
                            content_type=content_type)
    content = "attachment; filename=%s" % name
    response['Content-Disposition'] = content
    return response


def get_file(file, name="", content_type='text/xml'):
    response = FileResponse(open(os.path.abspath(os.path.join(s.MEDIA_ROOT, '..', 'templates', file)), 'rb'),
                            content_type=content_type)
    # content = "attachment; filename=%s" % name
    # response['Content-Disposition'] = content
    return response


class GenerateMixing(View):
    def get(self, request, id=None):
        if id == 0:
            return get_file('mixing.pdf', content_type='application/pdf')

        report = Report.objects.get(report_id=id)
        car = report.car
        contract = report.contract
        customer = contract.customer
        context = {
            'car': car,
            'customer': customer,
            'report': report,
            'qrcode': get_qrc_code(qr_company=report.pdf_qr_code_company, qr_user=report.pdf_qr_code_user),
            'contract': contract,
        }
        try:
            file = TemplateMixing.objects.last().template
            print("asdsad")
            print(file)
            splited = file.name.split('/')
            print(splited)
            path = os.path.join(s.MEDIA_ROOT, "{}".format(splited[0]))
            pdf = PyPDFML(splited[-1], path)
            pdf.generate(context)
        except (jinja2.exceptions.TemplateNotFound, AttributeError):
            pdf = PyPDFML('mixing.xml')
            print("ERROR OCCURED")
            pdf.generate(context)
        data = pdf.contents()
        response = FileResponse(ContentFile(data), content_type='application/pdf')
        return response


def finish_view(request, key):
    pdf = generate_finish_pdf(Report.objects.get(key=key))
    reponse = FileResponse(ContentFile(pdf), content_type='application/pdf', as_attachment=False)
    return reponse


def generate_finish_pdf(report):
    id = report.report_id
    car = report.car
    try:
        enumeration = Enumeration.objects.get(report_id=id)
    except Enumeration.DoesNotExist:
        enumeration = None
    contract = report.contract
    customer = contract.customer
    qrcode = get_qrc_code(qr_company=report.pdf_qr_code_company)
    context = {
        'car': car,

        'customer': customer,
        'enumeration': enumeration,
        'report': report,
        'qrcode': check_qr_code(qrcode),
        'contract': contract,
        'qrcode_some': QRcode.qrcode("{url}/pdf/{link}".format(url=s.URL_FILES, link=createQRcodeForReport(report))),
        # 'qrcode_some': QRcode.qrcode('https://people.ischool.berkeley.edu/~buckland/20THCENT.pdf')
    }
    file_path = get_name(TemplateMixing.objects.last())
    return generate_pdf(default_template="finishing_report.html", main_template_path=file_path,
                        css_name="finish_report.css", context=context)


def createQRcodeForReport(report: Report) -> str:
    if report.type_report == 0:
        return str(report.key)
    if report.type_report == 1:
        return 'additional/{}'.format(report.key)
    if report.type_report == 2:
        return 'enumeration/{}'.format(report.key)
    if report.type_report == 3:
        return 'disposable/{}'.format(report.key)


def agreement_view(request, key):
    report = Report.objects.get(key=key)
    id = report.report_id
    calculation = Calculation.objects.get(report_id=id)
    contract = report.contract
    context = {
        'calculation': calculation,

        'report': report,
        'car': report.car,
        'customer': report.contract.customer,
        'qrcode_company': check_qr_code(report.pdf_qr_code_company),
        'contract': contract,
    }

    file_name = get_name(TemplateAgreement.objects.last())
    pdf = generate_pdf(context=context, default_template="aggreement_report.html", main_template_path=file_name,
                       css_name='aggreement_report.css')
    response = FileResponse(ContentFile(pdf), content_type='application/pdf', as_attachment=False)
    return response


def test_report(request, id: int):
    pdf = generate_pdf_report(id, TemplateBase)
    response = FileResponse(ContentFile(pdf), content_type='application/pdf')
    return response


def test_report_additional(request, id: int):
    pdf = generate_pdf_report(id, TemplateAdditional)
    response = FileResponse(ContentFile(pdf), content_type='application/pdf', as_attachment=False, )
    return response


def generate_pdf_enumeration(id: int, obj):
    context = generate_pdf_base(id)
    context['enumeration'] = Enumeration.objects.get(report_id=id)
    file_name = get_name(obj)
    return generate_pdf(context=context, default_template="report.html", main_template_path=file_name,
                        css_name="report.css")


def generate_pdf_base(id: int) -> dict:
    locale.setlocale(locale.LC_ALL, 'C')
    new_report_pdf = Report.objects.get(report_id=id)
    calculation = Calculation.objects.get(report_id=id)
    contract = Contract.objects.get(contract_id=new_report_pdf.contract_id)
    holds_images = HoldsImages.objects.get(report_id=id)
    images = holds_images.image.all()
    passport = holds_images.pp_photo.all()
    checks = holds_images.checks.first()
    other_photos = holds_images.o_images.all()
    document_photo = Documents.objects.first()
    context = {
        'calculation': calculation,

        'contract': contract,
        'report': new_report_pdf,
        'services': new_report_pdf.service.all().__len__(),
        'datetime': new_report_pdf.report_date,
        'qrcode': check_qr_code(new_report_pdf.pdf_qr_code_user),
        'qrcode_company': check_qr_code(new_report_pdf.pdf_qr_code_company),
        'images': images,
        'document_photo': document_photo,
        'passport': passport,
        'checks': checks,
        'other_photos': other_photos,
    }
    return context


def generate_pdf_report(id: int, obj):
    context = generate_pdf_base(id)
    file_name = get_name(obj.objects.last())
    return generate_pdf(context=context, default_template="report.html", main_template_path=file_name,
                        css_name="report.css")


class GenerateAgreement(View):
    def get(self, request, id=None):
        if id == 0:
            return get_file('agreement.pdf', content_type='application/pdf')
        report = Report.objects.get(report_id=id)
        calculation = Calculation.objects.get(report_id=id)
        contract = report.contract
        context = {
            'calculation': calculation,
            'report': report,
            'qrcode': report.pdf_qr_code_company,
            'contract': contract,
        }
        try:
            file = TemplateAgreement.objects.last().template
            splited = file.name.split('/')
            path = os.path.join(s.MEDIA_ROOT, "{}".format(splited[0]))
            pdf = PyPDFML(splited[-1], path)
            pdf.generate(context)
        except (jinja2.exceptions.TemplateNotFound, AttributeError):
            pdf = PyPDFML('agreem.xml')
            pdf.generate(context)

        data = pdf.contents()
        response = FileResponse(ContentFile(data), content_type='application/pdf', as_attachment=False, )
        return response


def get_qrc_code(qr_company="", qr_user=""):
    if (qr_company is not None and qr_user is not None) and (qr_company != "" and qr_user != ""):
        return "{company} {user}".format(company=qr_company, user=qr_user)
    elif qr_company is not None and qr_company != "":
        return qr_company
    elif qr_user is not None and qr_user != "":
        return qr_user
    return None


class GenerateAdditional(View):
    def get(self, request, key=None):
        try:
            report_pdf = Report.objects.get(key=key)
            response = FileResponse(open(os.path.abspath(os.path.join(report_pdf.pdf_report_additional.path)), 'rb'),
                                    as_attachment=False,
                                    content_type='application/pdf')
            return response
        except:
            return get_file(file='base.pdf', name='asd', content_type='application/pdf')


class GeneratePDF(View):
    def get(self, request, key=None):
        # # try:
        # try:
        #     report_pdf = Report.objects.get(report_id=key)
        # except:
        try:
            report_pdf = Report.objects.get(key=key)
            pdf = open(os.path.abspath(os.path.join(report_pdf.pdf_report.path)), 'rb')
            response = HttpResponse(
                content_type='application/pdf')
            response['Content-Disposition'] = 'inline'
            response.write(pdf.read())
            return response
        except:
            return get_file('base.pdf', content_type='application/pdf')


class ShowEnumerationPDF(View):
    def get(self, request, key=None):
        enumeration = Enumeration.objects.get(report__key=key)
        response = FileResponse(open(os.path.abspath(os.path.join(enumeration.pdf_report_enumeration.path)), 'rb'),
                                as_attachment=False,
                                content_type='application/pdf')
        return response


class ShowDisposablePDF(View):
    def get(self, request, key=None):
        report = Report.objects.get(key=key)
        response = FileResponse(open(os.path.abspath(os.path.join(report.pdf_report_additional.path)), 'rb'),
                                as_attachment=False,
                                content_type='application/pdf')
        return response


def create_base64(new_report_pdf: Report):
    if new_report_pdf.pdf_report_base64 is None or new_report_pdf.pdf_report_base64 == "":
        locale.setlocale(locale.LC_ALL, 'C')
        calculation = Calculation.objects.create()
        context = {
            'calculation': calculation,

            'report': new_report_pdf,
            'car': new_report_pdf.car,
            'customer': new_report_pdf.contract.customer,
            'qrcode': check_qr_code(new_report_pdf.pdf_qr_code_user),
            'contract': new_report_pdf.contract,
        }
        file_name = get_name(TemplateAgreement.objects.last())
        data = generate_pdf(context=context, default_template="aggreement_report.html", main_template_path=file_name,
                            css_name="aggreement_report.css")
        filename = "%s.pdf" % new_report_pdf.car.car_number
        new_report_pdf.save_pdf(filename, data)
        with open(new_report_pdf.pdf_report.path, "rb") as file:
            encoded_string = base64.b64encode(file.read())
        new_report_pdf.pdf_report_base64 = encoded_string.decode('ascii')
        new_report_pdf.save()


# test it I think there is high chance of appearing error
def create_base64_closing(report: Report):
    if report.pdf_report_base64 is None or report.pdf_report_base64 == "":
        pdf = generate_finish_pdf(report)
        file = ContentFile(pdf)
        encode_string = base64.b64encode(file.read())
        report.pdf_report_base64 = encode_string.decode('ascii')
        report.save()


# How to return closing pdf !!!
def closing_pdf(request, key=""):
    report = Report.objects.get(key=key)
    closing = Closing.objects.get(report_id=report.report_id)
    enumeration = Enumeration.objects.get(report_id=report.report_id)
    car = report.car
    contract = report.contract
    customer = contract.customer
    qrcode = get_qrc_code(qr_company=report.pdf_qr_code_company)
    context = {
        'enumeration': enumeration,
        'closing': closing,
        'report': report,
        'qrcode': check_qr_code(qrcode),
        'contract': contract,
        'car': car,
        'customer': customer,
        'qrcode_some': QRcode.qrcode("http://e-otsenka.uz/pdf/{id}".format(id=report.report_id))
    }

    pdf = generate_pdf(default_template="closing.html",
                       css_name="finish_report.css", context=context)
    reponse = FileResponse(ContentFile(pdf), content_type='application/pdf')
    return reponse
