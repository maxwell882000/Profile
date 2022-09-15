from django.contrib import admin
from django.urls import path, include
from .views import *
from .tasks import get_base

urlpatterns = [
    path('mixing/<key>', finish_view, name='get_mixing'),
    path('agreement/<key>', agreement_view, name='get_agreement'),
    path('additional/<key>/', GenerateAdditional.as_view(), name='get_additional'),
    path("download_xml/", get_base_template, name='download_xml'),
    path("make_pdf/", get_base, name='make_pdf'),
    path("make_pdf_additional/", get_base_additional_template, name='make_pdf_additional'),
    path("download_xml_mixing/", get_base_mixing_template, name='download_xml_mixing'),
    path("download_xml_agreement/", get_base_agreement_template, name='download_xml_agreement'),
    path("download_xml_additional/", get_base_additional_template, name="download_xml_additional"),
    # path("test_finish/<int:id>", finish_view),
    # path("test_agreement/<int:id>", agreement_view),
    # path("test_report/<int:id>", test_report),
    # new methods which have to implemented
    path('enumeration/<key>/', ShowEnumerationPDF.as_view(), name='get_enumeration'),
    path('disposable/<key>/', ShowDisposablePDF.as_view(), name='get_disposable'),
    path('closing/<key>/', closing_pdf, name='get_closing'),
    path('<key>/', GeneratePDF.as_view(), name='get_response'),
]
