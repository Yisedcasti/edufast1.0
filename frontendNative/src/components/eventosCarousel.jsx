import React, { useEffect } from 'react';
import { FlatList, View, Text, Image, Dimensions, StyleSheet } from 'react-native';

const { width: screenWidth } = Dimensions.get('window');

const EventosCarousel = ({ eventos }) => {

    useEffect(() => {
        const fetchEventos = async () => {
            try {
                const response = await fetch("https://${API_URL}/MVC/", {
                    params: { action: "obtenerEventos" },
                })
            } catch (error) {
                console.error("Error al obtener noticias : ", error);
            } finally {
                setLoading(false);
            }
        };
        fetchEventos();
    }, []);

    const renderItem = ({ item }) => (
        <View style={styles.card}>
            <Image source={{ uri: item.img }} style={styles.image} />
            <View style={styles.caption}>
                <Text style={styles.title}>{item.evento}</Text>
                <Text style={styles.date}>{item.fecha_evento}</Text>
                <Text style={styles.name}>{item.nombres}</Text>
            </View>
        </View>
    );

    return (
        <FlatList
            data={eventos}
            renderItem={renderItem}
            keyExtractor={(_, index) => index.toString()}
            horizontal
            pagingEnabled
            showsHorizontalScrollIndicator={false}
        />
    );
};
const styles = StyleSheet.create({
    card: {
        width: screenWidth * 0.8,
        marginHorizontal: screenWidth * 0.05,
        borderRadius: 16,
        backgroundColor: '#ffffff',
        overflow: 'hidden',
        shadowColor: '#000',
        shadowOffset: { width: 0, height: 4 },
        shadowOpacity: 0.1,
        shadowRadius: 6,
        elevation: 5,
    },
    image: {
        width: '100%',
        height: 200,
        resizeMode: 'cover',
    },
    caption: {
        backgroundColor: '#f8f9fa',
        paddingVertical: 12,
        paddingHorizontal: 16,
    },
    title: {
        fontSize: 18,
        fontWeight: 'bold',
        color: '#212529',
        marginBottom: 4,
    },
    date: {
        fontSize: 14,
        color: '#6c757d',
        marginBottom: 2,
    },
    name: {
        fontSize: 14,
        color: '#495057',
    },
});

export default EventosCarousel;