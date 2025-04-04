import React, { useState } from 'react';
import {
    View, Text, TextInput, Alert,
    ScrollView, StyleSheet, TouchableOpacity
} from 'react-native';

export default function RegistroScreen({ navigation }) {
    const [form, setForm] = useState({
        id_rol: '',
        tipo_doc: '',
        num_doc: '',
        nombre: '',
        apellido: '',
        celular: '',
        telefono: '',
        direccion: '',
        correo: '',
        contraseña: '',
    });

    const handleChange = (field, value) => {
        setForm({ ...form, [field]: value });
    };

    const handleSubmit = () => {
        // Aquí haces la petición a tu backend con fetch o axios
        Alert.alert("Registro enviado", "Implementa la petición al backend aquí.");
    };

    const handleLoginRedirect = () => {
        navigation.navigate('Login'); // Asegúrate que 'Login' esté en tu stack navigator
    };

    return (
        <ScrollView contentContainerStyle={styles.container}>
            <View style={styles.card}>
                <Text style={styles.title}>Crear cuenta</Text>

                <Text style={styles.label}>Tipo de documento</Text>
                <TextInput
                    style={styles.input}
                    placeholder="CC, TI, etc."
                    onChangeText={(value) => handleChange('tipo_doc', value)}
                />

                <Text style={styles.label}>Número de documento</Text>
                <TextInput
                    style={styles.input}
                    keyboardType="numeric"
                    maxLength={10}
                    placeholder="Ej: 1234567890"
                    onChangeText={(value) => handleChange('num_doc', value)}
                />

                <Text style={styles.label}>Nombre completo</Text>
                <TextInput
                    style={styles.input}
                    placeholder="Tu nombre"
                    onChangeText={(value) => handleChange('nombre', value)}
                />

                <Text style={styles.label}>Apellido completo</Text>
                <TextInput
                    style={styles.input}
                    placeholder="Tu apellido"
                    onChangeText={(value) => handleChange('apellido', value)}
                />

                <Text style={styles.label}>Celular</Text>
                <TextInput
                    style={styles.input}
                    keyboardType="numeric"
                    maxLength={10}
                    placeholder="Ej: 3001234567"
                    onChangeText={(value) => handleChange('celular', value)}
                />

                <Text style={styles.label}>Teléfono</Text>
                <TextInput
                    style={styles.input}
                    keyboardType="numeric"
                    maxLength={7}
                    placeholder="Ej: 2345678"
                    onChangeText={(value) => handleChange('telefono', value)}
                />

                <Text style={styles.label}>Dirección</Text>
                <TextInput
                    style={styles.input}
                    placeholder="Ej: Calle 123 #45-67"
                    onChangeText={(value) => handleChange('direccion', value)}
                />

                <Text style={styles.label}>Correo</Text>
                <TextInput
                    style={styles.input}
                    keyboardType="email-address"
                    placeholder="correo@ejemplo.com"
                    onChangeText={(value) => handleChange('correo', value)}
                />

                <Text style={styles.label}>Contraseña</Text>
                <TextInput
                    style={styles.input}
                    placeholder="Mínimo 6 caracteres"
                    secureTextEntry
                    onChangeText={(value) => handleChange('contraseña', value)}
                />

                <TouchableOpacity style={styles.button} onPress={handleSubmit}>
                    <Text style={styles.buttonText}>Registrar</Text>
                </TouchableOpacity>

                <TouchableOpacity onPress={handleLoginRedirect} style={styles.loginRedirect}>
                    <Text style={styles.loginText}>¿Ya tienes cuenta? <Text style={styles.loginLink}>Inicia sesión</Text></Text>
                </TouchableOpacity>
            </View>
        </ScrollView>
    );
}

const styles = StyleSheet.create({
    container: {
        flexGrow: 1,
        justifyContent: 'center',
        backgroundColor: '#f1f3f5',
        padding: 20
    },
    card: {
        backgroundColor: '#fff',
        borderRadius: 15,
        padding: 25,
        elevation: 6,
        shadowColor: '#000',
        shadowOpacity: 0.1,
        shadowRadius: 10,
        shadowOffset: { width: 0, height: 5 },
    },
    title: {
        fontSize: 26,
        fontWeight: 'bold',
        marginBottom: 20,
        textAlign: 'center',
        color: '#198754'
    },
    label: {
        fontWeight: 'bold',
        marginBottom: 5,
        color: '#333'
    },
    input: {
        borderWidth: 1,
        borderColor: '#ced4da',
        borderRadius: 8,
        padding: 10,
        marginBottom: 15,
        backgroundColor: '#fff'
    },
    button: {
        backgroundColor: '#198754',
        padding: 15,
        borderRadius: 8,
        alignItems: 'center',
        marginTop: 10
    },
    buttonText: {
        color: '#fff',
        fontWeight: 'bold',
        fontSize: 16
    },
    loginRedirect: {
        marginTop: 20,
        alignItems: 'center'
    },
    loginText: {
        color: '#555'
    },
    loginLink: {
        color: '#0d6efd',
        fontWeight: 'bold'
    }
});
