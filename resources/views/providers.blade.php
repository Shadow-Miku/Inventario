@extends('layouts.menu')

@section('title', 'Stock List')

@section('contents')

@if(Session::has('success'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle me-2" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
        </svg>
        <div>
            {{ Session::get('success') }}
        </div>
    </div>
    @endif

    @if(Session::has('updated'))
    <div class="alert alert-warning d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-highlighter me-2" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.096.644a2 2 0 0 1 2.791.036l1.433 1.433a2 2 0 0 1 .035 2.791l-.413.435-8.07 8.995a.5.5 0 0 1-.372.166h-3a.5.5 0 0 1-.234-.058l-.412.412A.5.5 0 0 1 2.5 15h-2a.5.5 0 0 1-.354-.854l1.412-1.412A.5.5 0 0 1 1.5 12.5v-3a.5.5 0 0 1 .166-.372l8.995-8.07zm-.115 1.47L2.727 9.52l3.753 3.753 7.406-8.254zm3.585 2.17.064-.068a1 1 0 0 0-.017-1.396L13.18 1.387a1 1 0 0 0-1.396-.018l-.068.065zM5.293 13.5 2.5 10.707v1.586L3.707 13.5z"/>
        </svg>
        <div>
            {{ Session::get('updated') }}
        </div>
    </div>
    @endif

    @if(Session::has('deleted'))
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle me-2" viewBox="0 0 16 16">
            <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
            <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
        </svg>
        <div>
            {{ Session::get('deleted') }}
        </div>
    </div>
@endif

<div class="button-container">
    <a class="btn btn-outline-success btn-sm create-provider-btn" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#registerProviderModal">Register provider <i class="bi bi-person-plus"></i></i"></a>
</div>

<table class="table table-striped table-hover text-center">
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Information</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($providers as $provider)
        <tr>
            <th scope="row">{{ $provider->id }}</th>
            <td>{{ $provider->provider_name }}</td>
            <td>
                <span class="badge bg-info">{{ $provider->email }}</span>
                <span class="badge bg-info">{{ $provider->address }}</span>
                {{-- <span class="badge bg-info">{{ $provider->phone }}</span> --}}
            </td>
            <td>
                <!-- Update button -->
                <a href="#"
                   class="btn btn-outline-primary btn-sm update-product-btn me-2"
                   data-bs-toggle="modal"
                   data-bs-target="#changeProviderModal"
                   data-id="{{ $provider->id }}"
                   data-name="{{ $provider->provider_name }}"
                   data-email="{{ $provider->email }}"
                   data-address="{{ $provider->address }}"
                   data-phone="{{ $provider->phone }}">
                   Update provider <i class="bi bi-pencil-square"></i>
                </a>

                <!-- Delete button -->
                <form action="{{ route('providers.destroy', $provider->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">Delete <i class="bi bi-trash"></i></button>
                </form>
                <a class="btn btn-outline-success btn-sm" href="#"
                   data-bs-toggle="modal"
                   data-bs-target="#contactProviderModal"
                   data-provider-id="{{ $provider->id }}"
                   data-provider-phone="{{ $provider->phone }}">
                   Request <i class="bi bi-whatsapp"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<!-- Modal Register Provider -->
<div class="modal fade" id="registerProviderModal" tabindex="-1" aria-labelledby="registerProviderLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register Provider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex">
                <form id="registerProviderForm" action="{{ route('providers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                            <div class="mb-3"> <!-- Estructura de js, name: base de datos, id: para js -->
                                <label for="create_provider_name" class="form-label" style="font-weight: bold;">Provider Name</label>
                                <input type="text" name="provider_name" id="create_provider_name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="create_email" class="form-label" style="font-weight: bold;">Email</label>
                                <input type="text" name="email" id="create_email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="create_address" class="form-label" style="font-weight: bold;">Address</label>
                                <input type="text" name="address" id="create_address" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="create_phone" class="form-label" style="font-weight: bold;">Cellphone</label>
                                <input type="cellphone" name="phone" id="create_phone" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary"> Register </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Provider -->
<div class="modal fade" id="changeProviderModal" tabindex="-1" aria-labelledby="changeProviderLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register Provider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex">
                <form id="changeProviderForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                            <div class="mb-3"> <!-- Estructura de js, name: base de datos, id: para js -->
                                <label for="update_provider_name" class="form-label" style="font-weight: bold;">Provider Name</label>
                                <input type="text" name="provider_name" id="update_provider_name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="update_email" class="form-label" style="font-weight: bold;">Email</label>
                                <input type="text" name="email" id="update_email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="update_address" class="form-label" style="font-weight: bold;">Address</label>
                                <input type="text" name="address" id="update_address" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="update_phone" class="form-label" style="font-weight: bold;">Cellphone</label>
                                <input type="cellphone" name="phone" id="update_phone" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary"> Register </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Contact Provider -->
<div class="modal fade" id="contactProviderModal" tabindex="-1" aria-labelledby="contactProviderLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="contactProviderForm" class="form" data-form>
                    @csrf
                    <div class="row g-3">
                        <div class="mb-3">
                            <label for="message" class="form-label" style="font-weight: bold;">Message</label>
                            <textarea type="text" name="provider_message" id="message" class="form-control" required></textarea>
                        </div>

                        <!-- Campo oculto para el número del proveedor -->
                        <input type="hidden" id="providerPhone" value="">

                        <button type="submit" class="btn btn-success">Send message <i class="bi bi-whatsapp"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

document.addEventListener('DOMContentLoaded', function() {
            const updateModal = document.getElementById('changeProviderModal');
            updateModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget; // Botón que abrió el modal
                const id = button.getAttribute('data-id');
                const prov_name = button.getAttribute('data-name');
                const email = button.getAttribute('data-email');
                const address = button.getAttribute('data-address');
                const phone = button.getAttribute('data-phone');

                // Actualiza la acción del formulario
                const form = document.getElementById('changeProviderForm');
                form.action = `/providers/update/${id}`;

                // Rellena los campos del formulario
                document.getElementById('update_provider_name').value = prov_name;
                document.getElementById('update_email').value = email;
                document.getElementById('update_address').value = address;
                document.getElementById('update_phone').value = phone;
            });
        });


//      Contactar a proveedores registrados

// Detectar cuando se abre el modal
document.getElementById('contactProviderModal').addEventListener('show.bs.modal', function (event) {
    // Botón que abrió el modal
    const button = event.relatedTarget;

    // Obtener el número del proveedor desde el data-attribute
    const providerPhone = button.getAttribute('data-provider-phone');

    // Asignar el número de teléfono al campo oculto
    document.getElementById('providerPhone').value = providerPhone;
});

// Enviar mensaje de WhatsApp al enviar el formulario
document.getElementById('contactProviderForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el envío del formulario

    // Obtén los valores del formulario
    const message = document.querySelector('textarea[name="provider_message"]').value;
    const phoneNumber = document.getElementById('providerPhone').value; // Número del proveedor

    // Construye el mensaje para WhatsApp
    const whatsappMessage = `${message}`;

    // Construye la URL de WhatsApp
    /* const whatsappURL = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(whatsappMessage)}`; */
    const whatsappURL = `https://api.whatsapp.com/send?phone=${phoneNumber}&text=${encodeURIComponent(message)}`;

    // Redirige a WhatsApp Web
    window.open(whatsappURL, '_blank');
});

</script>


@endSection
