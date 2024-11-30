from django.contrib import admin
from .models import Category, Article

# Register your models here.

class CategoryAdmin(admin.ModelAdmin):
    readonly_fields = ('created_at', 'updated_at')
    search_fields = ('name', 'description')
    list_display = ('name', 'description', 'created_at')
    ordering = ('-created_at',)

    def save_model(self, request, obj, form, change):
        if not obj.user_id:
            obj.user_id = request.user.id
        super().save_model(request, obj, form, change)  # Llama al método de la clase base

class ArticleAdmin(admin.ModelAdmin):
    readonly_fields = ('user', 'created_at', 'updated_at')
    search_fields = ('title', 'content', 'user', 'categories')
    list_filter = ('public', 'user', 'categories')
    list_display = ('title', 'public', 'user', 'created_at')
    ordering = ('-created_at',)

    def save_model(self, request, obj, form, change):
        if not obj.user_id:
            obj.user_id = request.user.id
        super().save_model(request, obj, form, change)  # Llama al método de la clase base

admin.site.register(Category, CategoryAdmin)
admin.site.register(Article, ArticleAdmin)


