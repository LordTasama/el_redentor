<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
        <label for="visitante_id" class="form-label">{{ __('Visitante Id') }}</label>
             <!--On change show a list of ids like a search-->
         
            <input type="number" name="visitante_id" class="form-control @error('visitante_id') is-invalid @enderror" value="{{ old('visitante_id', $visita?->visitante_id) }}" id="visitante_id" placeholder="Documento del visitante" list="visitante-id-list" oninput="updateVisitanteDatalist(this.value)">
            <span  class=" pt-3" id="visitante-id-list">
                @foreach($visitanteIds as $id)
                  
                @endforeach
            </span>
          {!! $errors->first('visitante_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
   
            <!-- Remove the duplicate input field -->
        </div>
       {!! $errors->first('visitante_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
        <label for="prisionero_id" class="form-label">{{ __('Prisionero Id') }}</label>
          <!--On change show a list of ids like a search-->
         
            <input type="number" name="prisionero_id" class="form-control @error('prisionero_id') is-invalid @enderror" value="{{ old('prisionero_id', $visita?->prisionero_id) }}" id="prisionero_id" placeholder="Id del prisionero" list="prisionero-id-list" oninput="updatePrisioneroDatalist(this.value)">
            <span  class=" pt-3" id="prisionero-id-list">
                @foreach($prisioneroIds as $id)
          
                @endforeach
            </span>
            {!! $errors->first('prisionero_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="inicio_visita" class="form-label">{{ __('Inicio de la visita') }}</label>
            <input type="datetime-local" name="inicioVisita" class="form-control @error('inicioVisita') is-invalid @enderror" value="{{ old('inicioVisita', $visita?->inicioVisita) }}" id="inicio_visita" placeholder="Inicio de la visita">
            {!! $errors->first('inicioVisita', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fin_visita" class="form-label">{{ __('Fin de la visita') }}</label>
            <input type="datetime-local" name="finVisita" class="form-control @error('finVisita') is-invalid @enderror" value="{{ old('finVisita', $visita?->finVisita) }}" id="fin_visita" placeholder="Fin de la visita">
            {!! $errors->first('finVisita', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
</div>
<script>
function updateVisitanteDatalist(term) {
    const dataList = document.getElementById('visitante-id-list');
    const url = '/visitas/search-visitante-ids'; // URL of the searchVisitanteIds method
    const inputField = document.getElementById('visitante_id');

    if (term.trim() === '') {
        // Clear the datalist options when the input field is empty
        dataList.innerHTML = '';
        return;
    }

    fetch(url + '?term=' + term)
        .then(response => response.json())
        .then(data => {
            const options = data.visitanteIds.map((item, index) => {
                return {
                    id: item.id,
                    documento: data.visitanteDocuments[index].documento
                };
            });

            dataList.innerHTML = '';
            options.forEach(option => {
                const button = document.createElement('button');
                button.textContent = `${option.id} - ${option.documento}`;
                button.setAttribute("class","btn btn-primary m-1")
                button.value = option.id;
                button.onclick = () => {
                    inputField.value = option.id;
                    dataList.innerHTML = ''; 
                };

                dataList.appendChild(button);
            });
        });
}

function updatePrisioneroDatalist(term) {
    const dataList = document.getElementById('prisionero-id-list');
    const url = '/visitas/search-prisionero-ids'; // URL of the searchPrisioneroIds method
    const inputField = document.getElementById('prisionero_id');

    if (term.trim() === '') {
        // Clear the datalist options when the input field is empty
        dataList.innerHTML = '';
        return;
    }

    fetch(url + '?term=' + term)
        .then(response => response.json())
        .then(data => {
            const options = data.prisioneroIds.map(item => item.id);

            dataList.innerHTML = '';
            options.forEach(id => {
                const button = document.createElement('button');
                button.textContent = id;
                button.setAttribute("class","btn btn-primary m-1")
                button.value = id;
                button.onclick = () => {
                    inputField.value = id;
                    dataList.innerHTML = ''; // Clear the options after selecting one
                };

                dataList.appendChild(button);
            });
        });
}

</script>