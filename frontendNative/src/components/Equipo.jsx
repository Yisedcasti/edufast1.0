import React, { useEffect, useState } from 'react';
import { View, Text, Image, StyleSheet, ActivityIndicator, ScrollView } from 'react-native';
import config from "../API/config";

const EquipoSection = () => {
    const [equipo, setEquipo] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchEquipo = async () => {
            try {
                const response = await fetch('https://${API_URL}/EDUFAST/MVC/', {
                    params: { action: "obtenerEquipo" },
                });

                const data = await response.json();
                setEquipo(data);
            } catch (error) {
                console.error('Error al obtener el equipo:', error);
            } finally {
                setLoading(false);
            }
        };

        fetchEquipo();
    }, []);

    return (
        <View style={styles.section}>
            <Text style={styles.subtitle}>Equipo</Text>
            {loading ? (
                <ActivityIndicator size="large" color="#007bff" />
            ) : (
                equipo.map((persona, idx) => (
                    <View key={idx} style={styles.card}>
                        <Image source={{ uri: persona.img }} style={styles.image} />
                        <Text style={styles.title}>{persona.rol}</Text>
                        <Text style={styles.text}>{persona.nombre}</Text>
                        <Text style={styles.text}>{persona.telefono}</Text>
                        <Text style={styles.text}>{persona.contacto}</Text>
                    </View>
                ))
            )}
        </View>
    );
};

const styles = StyleSheet.create({
    section: {
        padding: 16,
        backgroundColor: '#f1f3f5',
    },
    subtitle: {
        fontSize: 22,
        fontWeight: 'bold',
        color: '#212529',
        marginBottom: 12,
    },
    card: {
        backgroundColor: '#ffffff',
        borderRadius: 12,
        padding: 16,
        marginBottom: 12,
        alignItems: 'center',
        shadowColor: '#000',
        shadowOffset: { width: 0, height: 2 },
        shadowOpacity: 0.1,
        shadowRadius: 4,
        elevation: 3,
    },
    image: {
        width: 100,
        height: 100,
        borderRadius: 50,
        marginBottom: 12,
    },
    title: {
        fontSize: 18,
        fontWeight: '600',
        color: '#333',
        marginBottom: 4,
    },
    text: {
        fontSize: 14,
        color: '#555',
    },
});

export default EquipoSection;
