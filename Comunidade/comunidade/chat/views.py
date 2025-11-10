from django.shortcuts import render

# Create your views here.
from django.shortcuts import render, redirect, get_object_or_404
from django.contrib.auth.decorators import login_required
from django.contrib import messages
from django.http import JsonResponse
from .models import Grupo, Mensagem
from .forms import GrupoForm, MensagemForm

@login_required
def lista_grupos(request):
    grupos = Grupo.objects.all()
    return render(request, 'chat/lista_grupos.html', {'grupos': grupos})

@login_required
def criar_grupo(request):
    if request.method == 'POST':
        form = GrupoForm(request.POST)
        if form.is_valid():
            grupo = form.save(commit=False)
            grupo.criador = request.user
            grupo.save()
            grupo.membros.add(request.user)
            messages.success(request, 'Grupo criado com sucesso!')
            return redirect('chat:lista_grupos')
    else:
        form = GrupoForm()
    return render(request, 'chat/criar_grupo.html', {'form': form})

@login_required
def detalhes_grupo(request, grupo_id):
    grupo = get_object_or_404(Grupo, id=grupo_id)
    mensagens = grupo.mensagens.all()[:50]
    
    if request.method == 'POST':
        form = MensagemForm(request.POST)
        if form.is_valid():
            mensagem = form.save(commit=False)
            mensagem.grupo = grupo
            mensagem.autor = request.user
            mensagem.save()
            return redirect('chat:detalhes_grupo', grupo_id=grupo.id)
    else:
        form = MensagemForm()
    
    return render(request, 'chat/detalhes_grupo.html', {
        'grupo': grupo,
        'mensagens': mensagens,
        'form': form
    })

@login_required
def entrar_grupo(request, grupo_id):
    grupo = get_object_or_404(Grupo, id=grupo_id)
    grupo.membros.add(request.user)
    messages.success(request, f'Você entrou no grupo {grupo.nome}!')
    return redirect('chat:detalhes_grupo', grupo_id=grupo.id)

@login_required
def sair_grupo(request, grupo_id):
    grupo = get_object_or_404(Grupo, id=grupo_id)
    if grupo.criador != request.user:  # Impede que o criador saia
        grupo.membros.remove(request.user)
        messages.success(request, f'Você saiu do grupo {grupo.nome}!')
    return redirect('chat:lista_grupos')

@login_required
def carregar_mensagens(request, grupo_id):
    grupo = get_object_or_404(Grupo, id=grupo_id)
    mensagens = grupo.mensagens.all().order_by('data_envio')[:50]
    
    data = []
    for mensagem in mensagens:
        data.append({
            'autor': mensagem.autor.username,
            'conteudo': mensagem.conteudo,
            'data_envio': mensagem.data_envio.strftime('%d/%m/%Y %H:%M'),
        })
    
    return JsonResponse(data, safe=False)

@login_required
def excluir_grupo(request, grupo_id):
    grupo = get_object_or_404(Grupo, id=grupo_id)
    
    #Editado por marcos (Aqui testa a permissão para excluir o grupo)
    if not grupo.pode_excluir(request.user):
        messages.error(request, 'Você não tem permissão para excluir este grupo.')
        return redirect('chat:lista_grupos')
    
    if request.method == 'POST':
        nome_grupo = grupo.nome
        grupo.delete()
        messages.success(request, f'Grupo "{nome_grupo}" excluído com sucesso!')
        return redirect('chat:lista_grupos')
    
    # (Marcos) Se for GET, mostrar página de confirmação
    return render(request, 'chat/excluir_grupo.html', {'grupo': grupo})