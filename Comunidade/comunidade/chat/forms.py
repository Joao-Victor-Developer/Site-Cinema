#Criado do zero 

from django import forms
from .models import Grupo, Mensagem

class GrupoForm(forms.ModelForm):
    class Meta:
        model = Grupo
        fields = ['nome', 'descricao']
        widgets = {
            'nome': forms.TextInput(attrs={'class': 'form-control', 'placeholder': 'Nome do grupo'}),
            'descricao': forms.Textarea(attrs={'class': 'form-control', 'placeholder': 'Descrição do grupo', 'rows': 3}),
        }

class MensagemForm(forms.ModelForm):
    class Meta:
        model = Mensagem
        fields = ['conteudo']
        widgets = {
            'conteudo': forms.Textarea(attrs={
                'class': 'form-control',
                'placeholder': 'Digite sua mensagem...',
                'rows': 3
            }),
        }