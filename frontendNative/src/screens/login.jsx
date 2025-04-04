import React, { useState } from 'react';
import {
    View, Text, TextInput, TouchableOpacity,
    Image, Alert, StyleSheet, KeyboardAvoidingView, Platform
} from 'react-native';

export default function LoginScreen({ navigation }) {
    const [numDoc, setNumDoc] = useState('');
    const [pass, setPass] = useState('');

    const handleLogin = () => {
        if (!numDoc || !pass) {
            Alert.alert('Campos requeridos', 'Por favor ingresa todos los campos.');
            return;
        }

        // Aquí va la llamada al backend
        Alert.alert('Intentando iniciar sesión...', `Usuario: ${numDoc}`);
    };

    return (
        <KeyboardAvoidingView
            style={styles.container}
            behavior={Platform.OS === 'ios' ? 'padding' : undefined}
        >
            <View style={styles.card}>
                {/* Logo y marca */}
                <View style={styles.header}>
                    <Image
                        source={require('../../assets/logo.png')}
                        style={styles.logo}
                    />
                    <Text style={styles.brand}>EDUFAST</Text>
                </View>

                <Text style={styles.title}>Iniciar sesión</Text>

                <Text style={styles.label}>Usuario</Text>
                <TextInput
                    placeholder="Número de documento"
                    style={styles.input}
                    value={numDoc}
                    onChangeText={setNumDoc}
                    keyboardType="numeric"
                />
                <Text style={styles.helpText}>Ej: 1234567890</Text>

                <Text style={styles.label}>Contraseña</Text>
                <TextInput
                    placeholder="••••••••"
                    style={styles.input}
                    value={pass}
                    onChangeText={setPass}
                    secureTextEntry
                />
                <Text style={styles.helpText}>Tu contraseña es confidencial</Text>

                <TouchableOpacity style={styles.forgot} onPress={() => Alert.alert("Redirige al cambio de contraseña")}>
                    <Text style={styles.forgotText}>¿Olvidaste tu contraseña?</Text>
                </TouchableOpacity>

                <TouchableOpacity style={styles.button} onPress={handleLogin}>
                    <Text style={styles.buttonText}>Ingresar</Text>
                </TouchableOpacity>

                <TouchableOpacity style={styles.registerRedirect} onPress={() => navigation.navigate('registro')}>
                    <Text style={styles.registerText}>¿No tienes cuenta? <Text style={styles.registerLink}>Regístrate</Text></Text>
                </TouchableOpacity>
            </View>
        </KeyboardAvoidingView>
    );
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: '#f1f3f5',
        justifyContent: 'center',
        padding: 20
    },
    card: {
        backgroundColor: '#fff',
        borderRadius: 15,
        padding: 25,
        shadowColor: '#000',
        shadowOpacity: 0.1,
        shadowRadius: 10,
        shadowOffset: { width: 0, height: 5 },
        elevation: 6,
    },
    header: {
        flexDirection: 'row',
        alignItems: 'center',
        justifyContent: 'center',
        marginBottom: 25
    },
    logo: {
        width: 50,
        height: 50,
        marginRight: 10,
        resizeMode: 'contain'
    },
    brand: {
        fontSize: 24,
        fontWeight: 'bold',
        color: '#198754',
    },
    title: {
        fontSize: 22,
        fontWeight: '600',
        marginBottom: 25,
        textAlign: 'center',
        color: '#333'
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
        padding: 12,
        backgroundColor: '#fff',
        marginBottom: 8
    },
    helpText: {
        fontSize: 12,
        color: '#6c757d',
        marginBottom: 15
    },
    forgot: {
        alignSelf: 'flex-end',
        marginBottom: 20
    },
    forgotText: {
        color: '#0d6efd',
        fontSize: 13,
        fontWeight: '600'
    },
    button: {
        backgroundColor: '#0d6efd',
        paddingVertical: 15,
        borderRadius: 8,
        alignItems: 'center',
        marginBottom: 15
    },
    buttonText: {
        color: '#fff',
        fontWeight: 'bold',
        fontSize: 16
    },
    registerRedirect: {
        alignItems: 'center',
        marginTop: 10
    },
    registerText: {
        color: '#555'
    },
    registerLink: {
        color: '#198754',
        fontWeight: 'bold'
    }
});
