import React, { useEffect, useState } from 'react';
import {
    View, Text, StyleSheet, TouchableOpacity, ScrollView, Linking,
} from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';
import Icon from 'react-native-vector-icons/FontAwesome5';
import { useNavigation } from '@react-navigation/native';

const Inicio = () => {
    const [user, setUser] = useState(null);
    const navigation = useNavigation();

    useEffect(() => {
        const checkLogin = async () => {
            const userData = await AsyncStorage.getItem('user');
            if (!userData) {
                navigation.replace('Login');
            } else {
                setUser(JSON.parse(userData));
            }
        };
        checkLogin();
    }, []);

    const logout = async () => {
        await AsyncStorage.removeItem('user');
        navigation.replace('Login');
    };

    const Card = ({ icon, title, onPress }) => (
        <TouchableOpacity style={styles.card} onPress={onPress}>
            <Icon name={icon} size={30} color="#000" />
            <Text style={styles.cardTitle}>{title}</Text>
        </TouchableOpacity>
    );

    return (
        <View style={styles.container}>
            <Text style={styles.title}>Bienvenido, {user?.nombres}</Text>
            <Text style={styles.subtitle}>
                En este espacio podrás registrar estudiantes, profesores, coordinadores, materias, cursos, asistencia y mucho más.
            </Text>

            <ScrollView contentContainerStyle={styles.cardsContainer}>
                <Card icon="user-plus" title="Profesor" onPress={() => navigation.navigate('Profesores')} />
                <Card icon="check-circle" title="Materias" onPress={() => navigation.navigate('Materias')} />
                <Card icon="book" title="Actividades" onPress={() => navigation.navigate('Actividades')} />
                <Card icon="user" title="Alumno" onPress={() => navigation.navigate('Alumnos')} />
                <Card icon="calendar-alt" title="Jornadas" onPress={() => navigation.navigate('Jornadas')} />
                <Card icon="graduation-cap" title="Grados" onPress={() => navigation.navigate('Grados')} />
            </ScrollView>

            <TouchableOpacity onPress={logout} style={styles.logoutButton}>
                <Text style={styles.logoutText}>Cerrar sesión</Text>
            </TouchableOpacity>

            <View style={styles.footer}>
                <Text style={styles.footerText}>©2024 codeOpacity. Designed by EDUFAST</Text>
                <View style={styles.socials}>
                    <TouchableOpacity onPress={() => Linking.openURL('https://www.facebook.com/cedid.sanpablo.3?locale=es_LA')}>
                        <Icon name="facebook" size={20} color="#fff" />
                    </TouchableOpacity>
                    <TouchableOpacity onPress={() => Linking.openURL('https://www.instagram.com/plumapaulista/')}>
                        <Icon name="instagram" size={20} color="#fff" />
                    </TouchableOpacity>
                    <TouchableOpacity onPress={() => Linking.openURL('https://x.com/Cedidsanpablo')}>
                        <Icon name="twitter" size={20} color="#fff" />
                    </TouchableOpacity>
                    <TouchableOpacity onPress={() => Linking.openURL('mailto:cedidsanpablobosa7@educacionbogota.edu.co')}>
                        <Icon name="google" size={20} color="#fff" />
                    </TouchableOpacity>
                </View>
            </View>
        </View>
    );
};

const styles = StyleSheet.create({
    container: { flex: 1, padding: 20, backgroundColor: '#f8f9fa' },
    title: { fontSize: 28, fontWeight: 'bold', marginBottom: 10 },
    subtitle: { fontSize: 16, marginBottom: 20 },
    cardsContainer: { flexDirection: 'row', flexWrap: 'wrap', justifyContent: 'space-between' },
    card: {
        width: '48%',
        backgroundColor: '#fff',
        padding: 20,
        marginBottom: 15,
        alignItems: 'center',
        borderRadius: 10,
        elevation: 3,
    },
    cardTitle: { marginTop: 10, fontSize: 16, fontWeight: 'bold' },
    logoutButton: {
        backgroundColor: '#000',
        padding: 10,
        alignItems: 'center',
        marginTop: 20,
        borderRadius: 5,
    },
    logoutText: { color: '#fff', fontWeight: 'bold' },
    footer: {
        marginTop: 30,
        alignItems: 'center',
        backgroundColor: '#000',
        padding: 15,
        borderRadius: 5,
    },
    footerText: { color: '#fff' },
    socials: { flexDirection: 'row', gap: 10, marginTop: 5 },
});

export default Inicio;
