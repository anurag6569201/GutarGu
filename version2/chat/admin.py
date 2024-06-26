from django.contrib import admin
from chat.models import Messages
from import_export.admin import ImportExportModelAdmin

class MessagesAdmin(ImportExportModelAdmin):
    list_display=['user','reciepient','body']
    list_filter=['is_read']

admin.site.register(Messages,MessagesAdmin)